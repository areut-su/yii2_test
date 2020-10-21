<?php

namespace app\components\bank\clients;

use GuzzleHttp\Client;

abstract class BaseClient
{


  protected $baseUri;
  private $client;

  /**
   * @param string $uri
   * @param array $params
   * @return \Psr\Http\Message\ResponseInterface
   * @throws \Exception
   */
  protected function sendGet($uri, $params = []): string
  {
    if (!empty($params)) {
      $uri .= '?' . http_build_query($params);
    }
    $client = $this->getClient();
    \Yii::info(['Send GET:' . $this->baseUri . '- ' . $uri, $params]);
    \Yii::beginProfile('Send GET');
    $result = $this->checkResult($client->get($uri));
    \Yii::endProfile('Send GET');
    return $result;
  }

  /**
   * @return Client
   */
  protected function getClient(): Client
  {
    if ($this->client) {
      return $this->client;
    } else {
      return new Client(["base_uri" => $this->baseUri]);
    }
  }

  /**
   * @param $response
   * @return string
   * @throws \Exception
   */
  protected function checkResult(\Psr\Http\Message\ResponseInterface $response): string
  {
    $code = $response->getStatusCode();
    $reason = $response->getReasonPhrase();
    if ($code == 200) {
      return $response->getBody()->getContents();
    }
    throw new \Exception($reason, $code);
  }


}
