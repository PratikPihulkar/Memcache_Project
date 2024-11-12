<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


use App\Models\Memcache;

class MemcachedController extends Controller
{
    
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

   

    public function retrieve($key)
    {

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

    


    public function clearAll()
    {
        // Clear all cache
        Cache::flush();

        return response()->json([
            'message' => 'All cache cleared successfully',
        ]);
    }



    public function storeInCache(Request $request)
    {
        $id = $request->id;
        $ttl = $request->input('ttl', 60); // Default TTL set to 60 minutes

        try {
            // Check if the key exists in the cache
            if (Cache::has($id)) {
                $value = Cache::get($id);
                return response()->json([
                    'message' => 'Data retrieved from cache',
                    'key' => $id,
                    'value' => $value,
                ]);
            }

            // If not in cache, retrieve from database
            $movi = Memcache::find($id);

            if ($movi) {
                $value = $movi;
                // Store in cache
                Cache::put($id, $value, $ttl);

                return response()->json([
                    'message' => 'Data retrieved from database and cached',
                    'key' => $id,
                    'value' => $value,
                    'ttl' => $ttl,
                ]);
            } else {
                return response()->json([
                    'message' => 'Data not found in database',
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}

