#Anotações gerais sobre meu estudo relativo ao framework Symfony

## Setando configurações

```php
$container->setParameter('assetic.debug', 'true');
```

## Obtendo configurações

```php
$container->getParameter('assetic.debug');
```

## Template dos arquivos de Erro

```sequence
app/
└─ Resources/
   └─ TwigBundle/
      └─ views/
         └─ Exception/
            ├─ error404.html.twig
            ├─ error403.html.twig
            ├─ error.html.twig      # All other HTML errors (including 500)
            ├─ error404.json.twig
            ├─ error403.json.twig
            └─ error.json.twig      # All other JSON errors (including 500)
```

## Fetch em consulta a base de dados

```php
$conn = $this->get('database_connection');
$users = $conn->fetchAll('SELECT * FROM caa_categoria_noticia');

dump($users);
```

## Web.Config

```xml
<?xml version="1.0" encoding="UTF-8"?>
<configuration>
    <system.webServer>
        <defaultDocument enabled="true">
            <files>
                <clear />
                <add value="app.php" />
            </files>
        </defaultDocument>
        <rewrite>
            <rules>
                <clear />
                <rule name="blockAccessToPublic" patternSyntax="Wildcard" stopProcessing="true">
                    <match url="*" />
                    <conditions logicalGrouping="MatchAll" trackAllCaptures="false">
                        <add input="{URL}" pattern="/web/*" />
                    </conditions>
                    <action type="CustomResponse" statusCode="403" statusReason="Forbidden: Access is denied." statusDescription="You do not have permission to view this directory or page using the credentials that you supplied." />
                </rule>
                <rule name="RewriteAssetsToPublic" stopProcessing="true">
                    <match url="^(.*)(\.css|\.js|\.jpg|\.png|\.gif)$" />
                    <conditions logicalGrouping="MatchAll" trackAllCaptures="false">
                    </conditions>
                    <action type="Rewrite" url="web/{R:0}" />
                </rule>
                <rule name="RewriteRequestsToPublic" stopProcessing="true">
                    <match url="^(.*)$" />
                    <conditions logicalGrouping="MatchAll" trackAllCaptures="false">
                    </conditions>
                    <action type="Rewrite" url="web/app_dev.php/{R:0}" />
                </rule>
            </rules>
        </rewrite>
        <httpErrors errorMode="Detailed" />
    </system.webServer>
</configuration>
```

Onde o **web/app_dev.php/** define o ambiente que será aberto

## Request path info

```php
use Symfony\Component\HttpFoundation\Request;
```

```php
public function indexAction(Request $request)
{

	echo $request->getPathInfo();
	echo "<br>";
	echo $request->getRequestUri();

}
```

## Doctrine 

### Gerando a Entity

* Comando para o terminal
```php
php app/console generate:doctrine:entity
```
* Nome da entidade, Bundle:Referencia ( Ex.: LojaBundle:ProdutosCategorias )
* No formato mantenha annotation

### Definindo nome da tabela

```php
@ORM\Table(name="caa_nome")
```

#### Definindo nome de coluna

```php
@ORM\Column(name="caa_id", type="integer")
```

### Principais Tipos

```php
type="integer"
type="string"
type="text" 
```

### Impedir campo vazio

```php
use Symfony\Component\Validator\Constraints as Assert;

@Assert\NotBlank
```

#### Gerando o CRUD

```php
php app/console generate:doctrine:crud
```

### Tipos de Campos

http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/basic-mapping.html#doctrine-mapping-types

### Atualizando tabela com base no Entity

```php
php app/console doctrine:schema:update --force
```
Basicamente atualiza o SQL da tabela com base no Entity, Incrível!

### Atualizando o CRUD após uma atualização do Entity

```php
php app/console generate:doctrine:crud bundle:Entity --overwrite
```
Note que vai ser substituido o template gerado

### Verifica as Entity conhecidas e se tem algum erro básico

```php
doctrine:mapping:info
```

## Informações Úteis que podem ser obtidas

```php
// récupérer l'objet request
$request = $this->getRequest();
 
// Ajax request?
$request->isXmlHttpRequest();
 
// quel est le langage préféré ?
$request->getPreferredLanguage(array('en', 'fr'));
 
// get a $_GET parameter
$request->query->get('page'); 
 
// get a $_POST parameter
$request->request->get('page');
 
// get a cookie parameter
$request->cookies->get('page');
 
// get REQUEST_URI
$request->getPathInfo()

// récupérer l'entity manager de Doctrine
$em = $this->getDoctrine()->getEntityManager();
 
// récupérer un paramètre de l'application
// défini par exemple dans parameters.ini
$param = $this->container->getParameter('my_parameter');

// récupérer la locale courante :
$this->get('session')->getLocale();
 
// récupérer un service
$service = $this->get("myService");
 
// récupérer le "baseUrl (+ ou - complet)" de l'appli
$this->getRequest()->getBasePath();
$this->getRequest()->getBaseUrl();
 
// voir tous les paramètres enregistrés :
var_dump($this->container->parameters);
```

## Outros Comandos

```php
// Limpar Cache
php app/console cache:clear --env=[enviroment name] (prod/dev)
```

## Cria as referencias aos assets referentes aos Bundles

```php
php app/console assets:install web
```

## Arquivo base.html.twig

* O arquivo é localizado em **app\Resources\views**
* Quando ele é carregado, os blocos indicados nele são preenchidos pelos blocos do template.

**Exemplo:**

```php
// app\Resources\views\base.html.twig
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
</head>
<body>
{% block body %}{% endblock %}
</body>
</html>
```

```php
// src\Biblioteca\BibliotecaBundle\Resources\views\Produtos\index.html.twig

{% extends '::base.html.twig' %}

{% block body -%}
   Teste de Body
{% endblock %}
```

* Veja que todo o conteúdo do block body informado no index.html.twig foi inserido dentro do block body do arquivo base.html.twig

##  Comentários

```php
{# Comentário Aqui #}
```

## Criando o link de uma rota

```php
// Controle
/**
   * @Route("/new", name="produtos_new")
   */
```

```php
// Template
{{ path('produtos_new') }}
```

## Links Úteis

* [Documentação Show em PT-BR](https://github.com/andreia/symfony-docs-pt-BR/)
* [Dicas Úteis](http://www.kitpages.fr/fr/cms/22/aide-memoire-symfony2)