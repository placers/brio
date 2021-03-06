<?php

namespace placer\brio\tests;

use mako\http\routing\Controller;
use mako\view\ViewFactory;
use mako\utility\Str;

/**
*  $routes->group(['namespace' => 'placer\brio\tests'], function($routes)
*  {
*      $routes->get('/tests/{slug}?', 'TestsController::index');
*  });
*/
class TestsController extends Controller
{
	/**
	 * Index Action
	 * @param  ViewFactory $view
	 * @param  string      $slug
	 * @return string
	 */
	public function index(ViewFactory $view, $slug = 'autoescape'): string
	{
		$stubs = $this->getStubs();
		$view->assign('stub', $slug);
		$view->assign('pages', $stubs);
		$view->assign('title', $stubs[$slug]);

		$data = $this->getData($slug);
		$view->assign($key = key($data), $data[$key]);

		return $view->render('brio::tests');
	}

	/**
	 * Get Stubs
	 * @return array
	 */
	protected function getStubs(): array
	{
		$path = dirname(__DIR__) . '/resources/views/stubs';
		$templateFiles = array_diff(scandir($path), ['..', '.']);

		if (empty($templateFiles))
			return [];

		$stubs = [];
		foreach ($templateFiles as $file)
		{
			$fileName = str_replace('.html.brio', '', $file);

			if (strpos($fileName, '_') === 0)
				continue;

			$stubs[$fileName] = ucfirst(Str::underscored2camel($fileName));
		}

		return $stubs;
	}

	/**
	 * Get View data
	 * @param  string $slug
	 * @return array
	 */
	protected function getData(string $slug): array
	{
		switch ($slug)
		{
			case 'autoescape':
				return ['variable' => '<b>foo</b>'];
			case 'cycle':
				return ['items' => [1,2,3,4,5,6]];
			case 'loop_empty':
				return ['items' => []];
			case 'explode':
				return ['text' => 'foo,bar'];
			case 'expr':
				return ['user' => [
			        'status'  => 'active',
			        'pending' => true,
			        'banned'  => false,
			    	],
			    ];
			case 'filter':
				return ['var' => '"value"'];
			case 'for_range_minimax':
				return ['e' => [
					'min' => 5,
					'max' => 1,
					],
				];
			case 'foreach':
				return ['categories' => [
					[
						'category' => ['name' => 'First Category'],
						'subcategories' => [
							['name' => 'First subcategory'],
							['name' => 'Second subcategory'],
							['name' => 'Last subcategory'],
						],
					],
					[
						'category' => ['name' => 'Second Category'],
						'subcategories' => [
							['name' => 'First subcategory'],
							['name' => 'Last subcategory'],
						],
					],
				]];
			case 'ifchanged':
				return ['users' => [
				    [
				        'name' => 'Mike',
				        'age'  => 22,
				        'foo'  => 2,
				    ],
				    [
				        'name' => 'older Mike',
				        'age'  => 25,
				        'foo'  => 2,
				    ],
				    [
				        'name' => 'John',
				        'age'  => 22,
				        'foo'  => 1,
				    ],
					[
						'name' => 'older John',
						'age'  => 25,
						'foo'  => 2,
					]
				]];
			case 'if_in':
				return [ 'data' => [
					'names'  => ['Vicomte', 'Bragelonne'],
					'search' => 'Bragelonne',
				]];
			case 'intval':
				return ['data' => [
					'float5' => 5.01,
					'float6' => 6.99,
				]];
			case 'is_array':
				return ['data' => [
					'foo' => new \stdClass,
					'bar' => [],
				]];
			case 'join':
				return ['words' => ['one', 'two', 'three']];
			case 'loop':
				return ['data' => [
					'items'  => range(1, 4),
					'nested' => [
						[range(1, 4),  range(1, 20)],
						[range(1, 10), range(1, 90)],
						[range(1, 20), range(1, 1000)],
						[range(2, 7),  range(8, 15)],
					],
				]];
			case 'loop_object':
				$obj = new \stdClass;
				$obj->foo = 'FooProperty';
				$obj->bar = 'BarProperty';
				$objArr = [$obj];
				return ['data' => compact('obj', 'objArr')];
			case 'methods':
				return ['Object' => new \placer\brio\tests\TestStaticClass];
			case 'if_null':
				return ['data' => [
					'arr' => [
    					'foo'    => null,
    					'bar'    => false,
    					'foobar' => 0,
    				],
    			]];
			case 'object':
				$user = new \stdClass;
				$user->name = 'John';
				$user->nick['name'] = 'johnny';
				$entities['user'] = $user;
				return ['data' => compact('user', 'entities')];
			case 'pluralize':
				return ['data' => [
				    'single' => 1,
				    'triple' => 3,
				]];
			case 'regroup':
				return ['users' => [
					[
						'name' => 'foo',
						'age'  => 21,
					],
					[
						'name' => 'foobar',
						'age'  => 22,
					],
					[
						'name' => 'older Foo',
						'age'  => 23,
					],
					[
						'name' => 'older Bar',
						'age'  => 23,
					],
					[
						'name' => 'bar',
						'age'  => 21,
					],
					[
						'name' => 'older Foobar',
						'age'  => 23,
					],
				]];
			case 'word_limiter':
				return ['string' => [
					'short' => 'short text<br>',
					'long'  => 'long text string <br> new line<br> another line',
				]];
			case 'char_limiter':
				return ['string' => [
					'short' => 'Short text',
					'long'  => 'Long text<br><br><br><br><br><br> string',
				]];
			case 'with':
				return ['users' => [
					[
						'name' => 'yang mike',
						'age'   => 21,
					],
					[
						'name' => 'old denis',
						'age'   => 52,
					],
				]];
			default:
				return ['' => ''];
		}
	}

}
