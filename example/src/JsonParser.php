<?php
namespace Drupal\example;

class JsonParser {
    private $json_data;
    /**
     * TODO: Implement this function...
     */
    public function rank_tagged_content($content_array, $tags_array) {
        $this->read_data();

        $ranked_content_array = [];
        // TODO
        foreach ($tags_array as $tag) {
            foreach ($this->json_data as $json_item) {
                if (in_array($tag, $json_item->tags)) {
                    array_push($ranked_content_array, $json_item);
                }
            }
        }
        $ranked_content_array = $this->remove_duplicate($ranked_content_array);
        return $ranked_content_array;
    }

    /**
     * Create a function to remove duplicate fuction based on the name key
     * Normally each data will have ID associated which would be easier to filter duplicate data
     */
    public function remove_duplicate($unfiltered_data) {
        $name_list = [];
        $new_array = [];

        foreach ($unfiltered_data as $key => $value) {
            if(count($name_list) > 0) {
                if(!in_array($value->name,$name_list)) {
                    $name_list[] = $value->name;
                    $new_array[] = $value;
                }
            } else {
                $name_list[] = $value->name;
                $new_array[] = $value;
            }
        }
        return $new_array;
    }

    /**
     * Create a function to read Json data and parse the json to Array
     */
    public function read_data() {
        $source_path = drupal_get_path('module', 'example') . '/source.json';
        $json_local_data = file_get_contents($source_path);
        $this->json_data = json_decode($json_local_data);
    }
}
