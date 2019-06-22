
build:
	docker build -t blokflautijs/hatshop -f ../docker/laravel/compiled.Dockerfile ../
	docker build -t blokflautijs/hatshopweb -f ../docker/nginx/compiled.Dockerfile ../

tag:
	docker tag blokflautijs/hatshop:latest blokflautijs/hatshop:$(VERSION_TAG)
	docker tag blokflautijs/hatshopweb:latest blokflautijs/hatshopweb:$(VERSION_TAG)

push:
	docker push blokflautijs/hatshop:$(VERSION_TAG)
	docker push blokflautijs/hatshopweb:$(VERSION_TAG)
