<?php
namespace App\View\Components;

use Roots\Acorn\View\Component;

class People extends Component
{
    /**
     * The custom post type to query.
     *
     * @var string
     */
    public $postType = 'person';

    /**
     * The WP_Query object.
     *
     * @var object
     */
    public $people;

    /**
     * Create a new component instance.
     *
     * @param array $args
     * @return void
     */
    public function __construct($args = [])
    {
        $this->people = new \WP_Query(array_merge([
            'post_type' => $this->postType,
            'posts_per_page' => -1, // Get all posts
        ], $args));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.people');
    }
}