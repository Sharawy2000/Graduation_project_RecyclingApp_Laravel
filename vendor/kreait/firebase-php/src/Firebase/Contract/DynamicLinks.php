<?php

declare(strict_types=1);

namespace Kreait\Firebase\Contract;

use InvalidArgumentException;
use Kreait\Firebase\DynamicLink;
use Kreait\Firebase\DynamicLink\CreateDynamicLink;
use Kreait\Firebase\DynamicLink\CreateDynamicLink\FailedToCreateDynamicLink;
use Kreait\Firebase\DynamicLink\DynamicLinkStatistics;
use Kreait\Firebase\DynamicLink\GetStatisticsForDynamicLink;
use Kreait\Firebase\DynamicLink\ShortenLongDynamicLink;
use Kreait\Firebase\DynamicLink\ShortenLongDynamicLink\FailedToShortenLongDynamicLink;
use Stringable;

/**
 * @phpstan-import-type CreateDynamicLinkShape from CreateDynamicLink
 * @phpstan-import-type ShortenLongDynamicLinkShape from ShortenLongDynamicLink
 */
interface DynamicLinks
{
    /**
     * @param Stringable|non-empty-string|CreateDynamicLink|CreateDynamicLinkShape $url
     *
     * @throws InvalidArgumentException
     * @throws FailedToCreateDynamicLink
     */
    public function createUnguessableLink(Stringable|string|CreateDynamicLink|array $url): DynamicLink;

    /**
     * @param Stringable|non-empty-string|CreateDynamicLink|CreateDynamicLinkShape $url
     *
     * @throws InvalidArgumentException
     * @throws FailedToCreateDynamicLink
     */
    public function createShortLink(Stringable|string|CreateDynamicLink|array $url): DynamicLink;

    /**
     * @param Stringable|non-empty-string|CreateDynamicLink|CreateDynamicLinkShape $actionOrParametersOrUrl
     *
     * @throws InvalidArgumentException
     * @throws FailedToCreateDynamicLink
     */
    public function createDynamicLink(Stringable|string|CreateDynamicLink|array $actionOrParametersOrUrl, ?string $suffixType = null): DynamicLink;

    /**
     * @param Stringable|non-empty-string|ShortenLongDynamicLink|ShortenLongDynamicLinkShape $longDynamicLinkOrAction
     *
     * @throws InvalidArgumentException
     * @throws FailedToShortenLongDynamicLink
     */
    public function shortenLongDynamicLink(Stringable|string|ShortenLongDynamicLink|array $longDynamicLinkOrAction, ?string $suffixType = null): DynamicLink;

    /**
     * @throws InvalidArgumentException
     * @throws GetStatisticsForDynamicLink\FailedToGetStatisticsForDynamicLink
     */
    public function getStatistics(Stringable|string|GetStatisticsForDynamicLink $dynamicLinkOrAction, ?int $durationInDays = null): DynamicLinkStatistics;
}
