<?php

namespace App\Services;

class IeltsScoringService
{
    /**
     * Calculate the band score for a section.
     *
     * @param string $sectionType (listening, reading)
     * @param string $testType (academic, general)
     * @param int $rawScore
     * @return float
     */
    public function calculateSectionBand($sectionType, $testType, $rawScore)
    {
        $config = config("ielts.scoring.{$sectionType}.{$testType}");
        
        if (!$config) {
            return 0.0;
        }

        foreach ($config as $range => $band) {
            if (strpos($range, '-') !== false) {
                [$min, $max] = explode('-', $range);
                if ($rawScore >= $min && $rawScore <= $max) {
                    return (float) $band;
                }
            } else {
                if ($rawScore == $range) {
                    return (float) $band;
                }
            }
        }

        return 0.0;
    }

    /**
     * Calculate the overall band score.
     *
     * @param float $listening
     * @param float $reading
     * @param float $writing
     * @param float $speaking
     * @return float
     */
    public function calculateOverallBand($listening, $reading, $writing, $speaking)
    {
        $average = ($listening + $reading + $writing + $speaking) / 4;
        
        // IELTS rounding rule: Round to the nearest 0.5
        // If average is 6.125 -> 6.0
        // If average is 6.25 -> 6.5
        // If average is 6.75 -> 7.0
        
        $whole = floor($average);
        $fraction = $average - $whole;

        if ($fraction < 0.25) {
            return (float) $whole;
        } elseif ($fraction < 0.75) {
            return (float) $whole + 0.5;
        } else {
            return (float) $whole + 1.0;
        }
    }
}
