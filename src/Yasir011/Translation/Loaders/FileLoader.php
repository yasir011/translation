<?php namespace Yasir011\Translation\Loaders;

use Illuminate\Translation\LoaderInterface;
use Illuminate\Translation\FileLoader as LaravelFileLoader;
use Yasir011\Translation\Loaders\Loader;
use Yasir011\Translation\Providers\LanguageProvider as LanguageProvider;
use Yasir011\Translation\Providers\LanguageEntryProvider as LanguageEntryProvider;

class FileLoader extends Loader implements LoaderInterface {

	/**
	 * The laravel file loader instance.
	 *
	 * @var \Illuminate\Translation\FileLoader
	 */
	protected $laravelFileLoader;

	/**
	 * 	Create a new mixed loader instance.
	 *
	 * 	@param  \Yasir011\Lang\Providers\LanguageProvider  			$languageProvider
	 * 	@param 	\Yasir011\Lang\Providers\LanguageEntryProvider		$languageEntryProvider
	 *	@param 	\Illuminate\Foundation\Application  					$app
	 */
	public function __construct($languageProvider, $languageEntryProvider, $app)
	{
		parent::__construct($languageProvider, $languageEntryProvider, $app);
		$this->laravelFileLoader = new LaravelFileLoader($app['files'], $app['path'].DIRECTORY_SEPARATOR.'lang');
	}

	/**
	 * Load the messages strictly for the given locale without checking the cache or in case of a cache miss.
	 *
	 * @param  string  $locale
	 * @param  string  $group
	 * @param  string  $namespace
	 * @return array
	 */
	public function loadRawLocale($locale, $group, $namespace = null)
	{
		$namespace = $namespace ?: '*';
		return $this->laravelFileLoader->load($locale, $group, $namespace);
	}

}