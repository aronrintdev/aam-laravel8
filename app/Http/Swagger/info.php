<?php
/**
 *  @OA\Info(title="VOS Account API", version="1.8")
 *
 *  @OA\Server(url="/api201902")
 *  @OA\Server(url="https://stage.aam.v1sports.com/api201902")
 *
 * @OA\Response(
 *   response="NotFound",
 *   description="item not found",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *        allOf={@OA\Schema(ref="./jsonapi-schema.json#/definitions/failure")},
 *        @OA\Property(
 *         property="errors",
 *         type="array",
 *         @OA\Items(
 *           ref="./jsonapi-schema.json#/definitions/error"
 *         )
 *       )
 *     )
 *   )
 * )
 * @OA\SecurityScheme(
 *   in="header",
 *   bearerFormat="jwt",
 *   scheme="bearer",
 *   type="http",
 *   securityScheme="jwt_auth"
 * )
 * security={ {"jwt_auth":{}} }
 */

