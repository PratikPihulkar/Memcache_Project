<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MemcachedController extends Controller
{
    /**
     * Store data in the cache.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        $ttl = $request->input('ttl', 60); // Time to live in minutes (default: 60)

        // Store in Memcached
        Cache::put($key, $value, $ttl);

        return response()->json([
            'message' => 'Data cached successfully',
            'key' => $key,
            'ttl' => $ttl,
        ]);
    }

    /**
     * Retrieve data from the cache.
     *
     * @param string $key
     * @return \Illuminate\Http\JsonResponse
     */
    public function retrieve($key)
    {
        // Retrieve from Memcached
        if (Cache::has($key)) {
            $value = Cache::get($key);

            return response()->json([
                'key' => $key,
                'value' => $value,
            ]);
        }

        return response()->json([
            'message' => 'Key not found in cache',
        ], 404);
    }

    /**
     * Delete data from the cache.
     *
     * @param string $key
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($key)
    {
        // Delete from Memcached
        if (Cache::forget($key)) {
            return response()->json([
                'message' => 'Data deleted successfully',
                'key' => $key,
            ]);
        }

        return response()->json([
            'message' => 'Key not found in cache',
        ], 404);
    }

    /**
     * Clear all cached data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearAll()
    {
        // Clear all cache
        Cache::flush();

        return response()->json([
            'message' => 'All cache cleared successfully',
        ]);
    }
}
