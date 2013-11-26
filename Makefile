install: clean composer crawler

clean:
	rm -rf crawler

composer:
	php composer.phar install

crawler:
	git clone -b crawler https://github.com/joaolenon/TCC.git crawler
	cd crawler && php composer.phar install
