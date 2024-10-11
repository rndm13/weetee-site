<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

if (!function_exists('diff_attach_detach')) {
    // Accepts two collections of ids, first is the one currently attached and second is the one to be changed to.
    //
    // Returns an array of ids to attach and an array of ids to detach
    function diff_attach_detach(array $ids_cur, array $ids_new): array {
        $to_attach = [];

        foreach ($ids_new as $new) {
            $attach = true;

            foreach ($ids_cur as $cur) {
                if ($cur == $new) {
                    $attach = false;
                    break;
                }
            }

            if ($attach) {
                array_push($to_attach, $new);
            }
        }

        $to_detach = [];

        foreach ($ids_cur as $cur) {
            $detach = true;

            foreach ($ids_new as $new) {
                if ($cur == $new) {
                    $detach = false;
                    break;
                }
            }

            if ($detach) {
                array_push($to_detach, $cur);
            }
        }

        return [$to_attach, $to_detach];
    }
}
