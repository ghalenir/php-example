<?php

class Solution1 {
    private $json_data;
    /**
     * TODO: Implement this function...
     */
    public function rank_tagged_content($content_array, $tags_array) {
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
     * create a function to remove duplicate content
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
     * Creat a function to read json data
     */
    public function read_data() {
        $json_local_data = file_get_contents(__DIR__.'/source.json');
        $this->json_data = json_decode($json_local_data);
    }

}

$solution1 = new Solution1();
$solution1->read_data();
$content_array = [];

if(empty($_GET['tags'])) {
    $tags_array = ['301','insurance'];
} else {
    $tags_array = explode(",", @$_GET['tags']);
}
$a = $solution1->rank_tagged_content($content_array,$tags_array);
echo "<pre>";
print_r($a);
echo "</pre>";
?>