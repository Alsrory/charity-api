<?php

namespace App\Http\Controllers;

/**
 * @OA\Schema(
 *   schema="Role",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="name", type="string", example="admin"),
 *   @OA\Property(property="description", type="string", nullable=true)
 * )
 *
 * @OA\Schema(
 *   schema="User",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="name", type="string", example="Ahmed"),
 *   @OA\Property(property="email", type="string", example="user@example.com"),
 *   @OA\Property(property="phone", type="integer", example=77234566),
 *   @OA\Property(property="roles", type="array", @OA\Items(ref="#/components/schemas/Role"))
 * )
 *
 * @OA\Schema(
 *   schema="UserResponse",
 *   type="object",
 *   @OA\Property(property="status", type="boolean", example=true),
 *   @OA\Property(property="message", type="string", example="Users retrieved successfully"),
 *   @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/User"))
 * )
 *
 * @OA\Schema(
 *   schema="Subscriber",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="user", ref="#/components/schemas/User"),
 *   @OA\Property(property="subscription_status", type="string", example="active")
 * )
 *
 * @OA\Schema(
 *   schema="SubscriberResponse",
 *   type="object",
 *   @OA\Property(property="status", type="boolean", example=true),
 *   @OA\Property(property="message", type="string", example="Subscribers retrieved successfully"),
 *   @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Subscriber"))
 * )
 *
 * @OA\Schema(
 *   schema="Project",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="name", type="string", example="مشروع خيري"),
 *   @OA\Property(property="description", type="string", example="تفاصيل المشروع"),
 *   @OA\Property(property="status", type="string", example="active")
 * )
 *
 * @OA\Schema(
 *   schema="ProjectResponse",
 *   type="object",
 *   @OA\Property(property="status", type="boolean", example=true),
 *   @OA\Property(property="message", type="string", example="Projects retrieved successfully"),
 *   @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Project"))
 * )
 *
 * @OA\Schema(
 *   schema="Initiative",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="name", type="string", example="مبادرة خيرية"),
 *   @OA\Property(property="description", type="string", example="تفاصيل المبادرة")
 * )
 *
 * @OA\Schema(
 *   schema="InitiativeResponse",
 *   type="object",
 *   @OA\Property(property="status", type="boolean", example=true),
 *   @OA\Property(property="message", type="string", example="Initiatives retrieved successfully"),
 *   @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Initiative"))
 * )
 * 
 * @OA\Schema(
 *   schema="News",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="title", type="string", example="عنوان الخبر"),
 *   @OA\Property(property="content", type="string", example="تفاصيل الخبر"),
 *   @OA\Property(property="image", type="string", example="news.jpg"),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-22T12:00:00Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-22T12:00:00Z")
 * )
 *
 * @OA\Schema(
 *   schema="NewsResponse",
 *   type="object",
 *   @OA\Property(property="status", type="boolean", example=true),
 *   @OA\Property(property="message", type="string", example="News retrieved successfully"),
 *   @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/News"))
 * )
 *
 * @OA\Schema(
 *   schema="Subscription",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="subscriber_id", type="integer", example=1),
 *   @OA\Property(property="amount", type="number", example=100),
 *   @OA\Property(property="status", type="string", example="paid"),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-22T12:00:00Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-22T12:00:00Z")
 * )
 *
 * @OA\Schema(
 *   schema="SubscriptionResponse",
 *   type="object",
 *   @OA\Property(property="status", type="boolean", example=true),
 *   @OA\Property(property="message", type="string", example="Subscriptions retrieved successfully"),
 *   @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Subscription"))
 * )
 */

class ApiDocController extends Controller
{
    // هذا الملف فقط للتعليقات الخاصة بالـSwagger، لا يحتوي على دوال
}
