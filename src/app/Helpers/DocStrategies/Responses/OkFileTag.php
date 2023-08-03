<?php
namespace App\Helpers\DocStrategies\Responses;

use App\Enums\StatusCodes\HttpStatus;
use Knuckles\Camel\Extraction\ExtractedEndpointData;
use Knuckles\Scribe\Extracting\RouteDocBlocker;
use Knuckles\Scribe\Extracting\Strategies\Strategy;
use Knuckles\Scribe\Tools\AnnotationParser as a;
use Mpociot\Reflection\DocBlock\Tag;

/**
 * Get a response from from a file in the docblock ( @okFile ).
 */
class OkFileTag extends Strategy
{
    public function __invoke(ExtractedEndpointData $endpointData, array $routeRules = []): ?array
    {
        $docBlocks = RouteDocBlocker::getDocBlocksFromRoute($endpointData->route);
        $methodDocBlock = $docBlocks['method'];

        return $this->getFileResponses($methodDocBlock->getTags());
    }

    /**
     * Get the response from the file if available.
     *
     * @param Tag[] $tags
     *
     * @return array|null
     */
    public function getFileResponses(array $tags): ?array
    {
        // Avoid "holes" in the keys of the filtered array, by using array_values on the filtered array
        $responseFileTags = array_values(
            array_filter($tags, function ($tag) {
                return $tag instanceof Tag && strtolower($tag->getName()) === 'okfile';
            })
        );

        if (empty($responseFileTags)) {
            return null;
        }

        $responses = array_map(function (Tag $responseFileTag) {
            preg_match('/^(\d{3})?\s*(.*?)({.*})?$/', $responseFileTag->getContent(), $result);
            [$_, $status, $mainContent] = $result;
            $json = $result[3] ?? null;

            ['fields' => $attributes, 'content' => $filePath] =
                a::parseIntoContentAndFields($mainContent, ['status', 'scenario']);

            $status = $attributes['status'] ?: ($status ?? 200);
            $description = $attributes['scenario'] ? "$status, {$attributes['scenario']}" : "$status";

            if (!file_exists($filePath)) {
                // Try Laravel storage folder
                if (!file_exists(storage_path($filePath))) {
                    throw new \InvalidArgumentException("@okFile {$filePath} does not exist");
                }

                $filePath = storage_path($filePath);
            }
            $content = file_get_contents($filePath, true);
            if ($json) {
                $json = str_replace("'", '"', $json);
                $content = json_encode(array_merge(json_decode($content, true), json_decode($json, true)));
            }


            return [
                'content' => $content,
                'status' => HttpStatus::OK,
                'description' => HttpStatus::OK . ', ' . HttpStatus::msg(HttpStatus::OK),
            ];
        }, $responseFileTags);

        return $responses;
    }
}
