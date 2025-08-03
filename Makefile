.PHONY: help install test test-coverage cs cs-fix clean docs examples

help: ## Show this help message
	@echo 'Usage: make [target]'
	@echo ''
	@echo 'Targets:'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  %-15s %s\n", $$1, $$2}' $(MAKEFILE_LIST)

install: ## Install dependencies
	composer install

test: ## Run tests
	vendor/bin/phpunit

test-coverage: ## Run tests with coverage
	vendor/bin/phpunit --coverage-html coverage

cs: ## Run PHP CodeSniffer
	vendor/bin/phpcs src/ tests/ exemplos/

cs-fix: ## Fix code style issues
	vendor/bin/phpcbf src/ tests/ exemplos/

clean: ## Clean generated files
	rm -rf coverage/
	rm -rf vendor/
	rm -f composer.lock

docs: ## Generate documentation
	@echo "Documentation is in the docs/ directory"
	@echo "README.md contains comprehensive usage instructions"

examples: ## Run examples
	@echo "Running examples..."
	@php exemplos/autenticacao_sandbox.php
	@echo ""
	@php exemplos/incluir_boleto.php
	@echo ""
	@php exemplos/consultar_boletos.php
	@echo ""
	@php exemplos/webhook.php
	@echo ""
	@php exemplos/consultar_pix.php

validate: ## Validate composer.json
	composer validate --strict

security: ## Run security audit
	composer audit

all: install test cs ## Install, test and check code style

ci: install test cs security ## Run CI pipeline locally 