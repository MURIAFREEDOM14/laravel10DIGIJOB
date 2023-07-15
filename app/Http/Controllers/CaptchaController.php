<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManagerStatic as Image;
use App\Services\SlidingPuzzleGenerator;
use Mews\Captcha\Facades\Captcha;


class CaptchaController extends Controller
{
    protected $puzzleGenerator;
    public function __construct(SlidingPuzzleGenerator $puzzleGenerator)
    {
        $this->puzzleGenerator = $puzzleGenerator;
    }

    public function showSlidingPuzzle()
    {
        $backgroundImagePath = public_path('/gambar/Welcome.jpg');
        $outputFilePath = public_path('/gambar/Welcome.jpg');
        $puzzleWidth = 400;
        $puzzleHeight = 400;
        $numPieces = 9;

        // Generate the sliding puzzle image
        $this->puzzleGenerator->generatePuzzle($backgroundImagePath, $outputFilePath, $puzzleWidth, $puzzleHeight, $numPieces);

        // Display the sliding puzzle image in the view
        return view('captcha', ['puzzleImagePath' => $outputFilePath]);
    }

    public function verifySlidingPuzzle(Request $request)
    {
        // Perform the sliding puzzle verification logic
        // Retrieve and validate the user's response
        // Compare the user's response with the correct solution
        // Return appropriate response (success or failure)
    }
}