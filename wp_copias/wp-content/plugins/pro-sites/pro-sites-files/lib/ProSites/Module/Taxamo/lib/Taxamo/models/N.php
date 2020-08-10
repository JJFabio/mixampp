<?php
/**
 *  Copyright 2014 Taxamo, Ltd.
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

/**
 * $model.description$
 *
 * NOTE: This class is auto generated by the swagger code generator program. Do not edit the class manually.
 *
 */
class N {

  static $swaggerTypes = array(
      'day_raw' => 'string',
      'value' => 'number',
      'status' => 'string',
      'day' => 'string'

    );

  /**
  * Date for stats in yyyy-MM-dd'T'hh:mm:ss'Z' format.
  */
  public $day_raw; // string
  /**
  * Transaction count.
  */
  public $value; // number
  /**
  * Transaction status (C or N).
  */
  public $status; // string
  /**
  * Date for stats in yyyy-MM-dd format.
  */
  public $day; // string
  }
