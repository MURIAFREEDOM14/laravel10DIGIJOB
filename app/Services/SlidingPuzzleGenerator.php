<?php
namespace App\Services;
use Intervention\Image\ImageManagerStatic as Image;

class SlidingPuzzleGenerator
{
    public function generatePuzzle($backgroundImagePath, $outputFilePath, $puzzleWidth, $puzzleHeight, $numPieces)
    {
        $backgroundImage = Image::make($backgroundImagePath);

        // Calculate piece dimensions
        $pieceWidth = $puzzleWidth / $numPieces;
        $pieceHeight = $puzzleHeight / $numPieces;

        // Create canvas for the puzzle
        $puzzleImage = Image::canvas($puzzleWidth, $puzzleHeight);
        

        // Generate puzzle pieces
        for ($row = 0; $row < $numPieces; $row++) {
            for ($col = 0; $col < $numPieces; $col++) {
                // Crop the piece from the background image
                $piece = $backgroundImage->crop(100, 100, 50 * 100, 50 * 100);

                // Place the piece on the puzzle canvas
                $puzzleImage->insert(100,"50",50, "50", 100);
            }
        }
        // Save the generated sliding puzzle image
        $puzzleImage->save($outputFilePath);
    }
}
