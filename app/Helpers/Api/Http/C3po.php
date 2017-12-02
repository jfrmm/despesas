<?php
namespace App\Helpers\Api\Http;

/**
 * This class helps in formatting and translating data to a JSON response
 */
class C3po
{
    /**
     * Prepares a message to be included in JSON response
     *
     * @param string $file
     * @param string $entity
     * @param string $action
     * @param string $module
     *
     * @return string
     */
    public static function prepareMessage($file, $entity, $action, $module = null)
    {
        if ($module) {
            return trans(strtolower($module) . '::' . $file . '.' . $entity . '.' . $action);
        } else {
            return trans($file . '.' . $entity . '.' . $action);
        }
    }

    /**
     * Prepares data to be included in JSON response
     *
     * @param mixed $objectData
     * @param string $objectName
     * @param array $extraData
     *
     * @return array
     */
    public static function prepareData($objectData, $objectName = null, $extraData = null)
    {
        $data = [];

        if ($objectData instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            // return paginated data
            $objectData = $objectData->toArray();
            $data = $objectData['data'];
            unset($objectData['data']);

            $objectName = str_plural($objectName);

            if ($objectName) {
                $data = [
                    $objectName => $data,
                ];
            }

            // add some extra data
            if ($extraData) {
                foreach ($extraData as $k => $v) {
                    $data[$k] = $extraData[$k];
                }
            }

            return [
                'metadata' => [
                    'pagination' => $objectData
                ],
                'data' => $data,
            ];
        } else {
            // return non-paginated data
            if (!$objectData instanceof \Illuminate\Database\Eloquent\Model) {
                // multiple items
                $objectData = $objectData->get();
                $objectName = str_plural($objectName);
            }

            if (!$objectName) {
                $data = [
                    'data' => $objectData,
                ];
            } else {
                $data = [
                    'data' => [
                        $objectName => $objectData,
                    ]
                ];
            }

            // add some extra data
            if ($extraData) {
                foreach ($extraData as $k => $v) {
                    $data['data'][$k] = $extraData[$k];
                }
            }

            return $data;
        }
    }

    /**
     * Builds the generic JSON response
     *
     * @param int $statusCode
     * @param string $message
     * @param array $data
     *
     * @return Response
     */
    public static function respond($statusCode, $message, $data = null)
    {
        // build response
        if ($data) {
            $response = array_merge([
                'status_code' => $statusCode,
                'message' => $message,
            ], $data);
        } else {
            $response = [
                'status_code' => $statusCode,
                'message' => $message,
            ];
        }

        return response()->json($response, $statusCode);
    }
}
