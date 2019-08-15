<?php
/**
 * Copyright (c) 2009-2019. Weibo, Inc.
 *
 *    Licensed under the Apache License, Version 2.0 (the "License");
 *    you may not use this file except in compliance with the License.
 *    You may obtain a copy of the License at
 *
 *             http://www.apache.org/licenses/LICENSE-2.0
 *
 *    Unless required by applicable law or agreed to in writing, software
 *    distributed under the License is distributed on an "AS IS" BASIS,
 *    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *    See the License for the specific language governing permissions and
 *    limitations under the License.
 */


namespace Motan\Serialize;


use Breeze\BreezeReader;
use Breeze\BreezeWriter;
use Breeze\Buffer;

class Breeze implements \Motan\Serializer
{

    public function serialize($params)
    {
        $buf = new Buffer();
        BreezeWriter::writeValue($buf, $params);
        return $buf->buffer();
    }

    public function deserialize($obj, $data)
    {
        if (empty($data)) {
            return $obj;
        }
        return BreezeReader::readValue(new Buffer($data));
    }

    public function serializeMulti(...$params)
    {
        $buf = new Buffer();
        foreach ($params as $param) {
            BreezeWriter::writeValue($buf, $param);
        }
        return $buf->buffer();
    }
}