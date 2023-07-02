<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getData()
    {
        // Set up the Guzzle client
        $client = new Client(['base_uri' => 'https://api-v4.easyflor.eu/api/']);

        // Set the token for authentication
        $token = 'apiToken';

        try {
            // GET /api/article
            $response = $client->request('GET', '/article', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            // Handle the response
            if ($response->getStatusCode() === 200) {
                $articles = json_decode($response->getBody(), true);
                // Process the articles
            } else {
                // Handle the error
            }

            // GET /api/article/{articleId}
            $articleId = 'article_id_here';
            $response = $client->request('GET', '/article/'.$articleId, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            // Handle the response
            if ($response->getStatusCode() === 200) {
                $article = json_decode($response->getBody(), true);
                // Process the article
            } else {
                // Handle the error
            }

            // GET /api/articlegroup
            $response = $client->request('GET', '/articlegroup', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            // Handle the response
            if ($response->getStatusCode() === 200) {
                $articleGroups = json_decode($response->getBody(), true);
                // Process the article groups
            } else {
                // Handle the error
            }

            // GET /api/articlegroup/{articleGroupId}
            $articleGroupId = 'article_group_id_here';
            $response = $client->request('GET', '/articlegroup/'.$articleGroupId, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            // Handle the response
            if ($response->getStatusCode() === 200) {
                $articleGroup = json_decode($response->getBody(), true);
                // Process the article group
            } else {
                // Handle the error
            }

            // PUT /api/articlesort
            $articleSortIds = ['articleSortId1', 'articleSortId2'];
            $response = $client->request('PUT', '/articlesort', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
                'json' => [
                    'articleSorts' => $articleSortIds,
                ],
            ]);

            // Handle the response
            if ($response->getStatusCode() === 200) {
                $updatedArticleSorts = json_decode($response->getBody(), true);
                // Process the updated article sorts
            } else {
                // Handle the error
            }
        } catch (\Exception $e) {
            // Handle any exceptions
        }
    }
}
