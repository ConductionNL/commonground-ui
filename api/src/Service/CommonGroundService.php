<?php
// src/Service/CommonGroundService.php
namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface as CacheInterface;
use GuzzleHttp\Client ;
use GuzzleHttp\RequestOptions;

use Twig\Environment as Twig ;

class CommonGroundService
{
    private $params;
//    private $cache;
    private $client;
    private $session;
    private $twig;

    public function __construct(ParameterBagInterface $params, SessionInterface $session, CacheInterface $cache, Twig $twig)
    {
        $this->params = $params;
        $this->session = $session;
//        $this->cache = $cache;
        $this->twig = $twig;

        // We might want to overwrite the guzle config, so we declare it as a separate array that we can then later adjust, merge or otherwise influence
        $this->guzzleConfig = [
            'base_uri' => 'https://cgrc.common-ground.dev',
            // Base URI is used with relative requests
            'http_errors' => false,
            //'base_uri' => 'https://wrc.zaakonline.nl/applications/536bfb73-63a5-4719-b535-d835607b88b2/',
            // You can set any number of default request options.
            'timeout'  => 4000.0,
            // To work with NLX we need a couple of default headers
            'headers' => [
                'Accept'  => 'application/ld+json',
                'Content-Type'  => 'application/json',
                //'X-NLX-Request-User-Id' => '64YsjzZkrWWnK8bUflg8fFC1ojqv5lDn'				// the id of the user performing the request
                //'X-NLX-Request-Application-Id' => '64YsjzZkrWWnK8bUflg8fFC1ojqv5lDn' 		// the id of the application performing the request
                //'X-NLX-Request-Subject-Identifier' => '64YsjzZkrWWnK8bUflg8fFC1ojqv5lDn' 	// an subject identifier for purpose registration (doelbinding)
                //'X-NLX-Request-Process-Id' => '64YsjzZkrWWnK8bUflg8fFC1ojqv5lDn' 			// a process id for purpose registration (doelbinding)
                //'X-NLX-Request-Data-Elements' => '64YsjzZkrWWnK8bUflg8fFC1ojqv5lDn' 		// a list of requested data elements
                //'X-NLX-Request-Data-Subject' => '64YsjzZkrWWnK8bUflg8fFC1ojqv5lDn' 		// a key-value list of data subjects related to this request. e.g. bsn=12345678,kenteken=ab-12-fg
            ]
        ];

        // Lets start up a default client
        $this->client= new Client($this->guzzleConfig);
    }

    /*
     * Get a single resource from a common ground componant
     */
    public function getResourceList(?string $uri, $force = false)
    {

//        $item = $this->cache->getItem('commonground_'.md5 ($url));
//        if ($item->isHit() && !$force) {
//            //return $item->get();
//        }
        if(!$uri)
            $uri = "components/page=1";
        $response = $this->client->get($uri);

        if($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $componentsUncleaned = $data->_embedded->item;
            $components = [];
            foreach ($componentsUncleaned as $component) {
                if ($component->commonground)
                    array_push($components, $component);
            }
            if ($next = $data->_links->next) {
                array_merge($components, $this->getResourceList($next));
            }
            return $components;
        }
        else
            return false;
    }

    /*
     * Get a single resource from a common ground componant
     */
    public function getResource($uri, $force = false)
    {
        $response = $this->client->get($uri);
        if($response->getStatusCode() == 200)
            return json_decode($response);
        else
            return false;
    }

    /*
     * Get a single resource from a common ground componant
     */



}
