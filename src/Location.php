<?php

/**
 * @file
 * Contains \Triquanta\IziTravel\Location.
 */

namespace Triquanta\IziTravel;

/**
 * Provides a location data type.
 */
class Location implements LocationInterface {

  /**
   * The latitude.
   *
   * @var float|null
   */
  protected $latitude;

  /**
   * The longitude.
   *
   * @var float|null
   */
  protected $longitude;

  /**
   * The altitude.
   *
   * @var float|null
   */
  protected $altitude;

  /**
   * The exhibit number.
   *
   * @var string|null
   */
  protected $exhibitNumber;

  /**
   * The public IP address.
   *
   * @var string|null
   */
  protected $publicIpAddress;

  /**
   * Creates a new instance.
   *
   * @param float|null $latitude
   * @param float|null $longitude
   * @param float|null $altitude
   * @param string|null $exhibit_number
   * @param string|null $public_ip_address
   */
  public function __construct($latitude, $longitude, $altitude, $exhibit_number, $public_ip_address) {
    $this->latitude = $latitude;
    $this->longitude = $longitude;
    $this->altitude = $altitude;
    $this->exhibitNumber = $exhibit_number;
    $this->publicIpAddress = $public_ip_address;
  }

  /**
   * {@inheritdoc}
   */
  public static function createFromJson($json) {
    $data = json_decode($json);
    if (is_null($data)) {
      throw new InvalidJsonFactoryException($json);
    }
    $data = (array) $data + [
      'latitude' => NULL,
      'longitude' => NULL,
      'altitude' => NULL,
      'number' => NULL,
      'ip' => NULL,
    ];
    if ($data['ip'] && filter_var($data['ip'], FILTER_VALIDATE_IP) === FALSE) {
      throw new InvalidIpAddressFactoryException($data['ip'], $json);
    }
    return new static($data['latitude'], $data['longitude'], $data['altitude'], $data['number'], $data['ip']);
  }

  /**
   * {@inheritdoc}
   */
  public function getLatitude() {
    return $this->latitude;
  }

  /**
   * {@inheritdoc}
   */
  public function getLongitude() {
    return $this->longitude;
  }

  /**
   * {@inheritdoc}
   */
  public function getAltitude() {
    return $this->altitude;
  }

  /**
   * {@inheritdoc}
   */
  public function getExhibitNumber() {
    return $this->exhibitNumber;
  }

  /**
   * {@inheritdoc}
   */
  public function getPublicIpAddress() {
    return $this->publicIpAddress;
  }

}