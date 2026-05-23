<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* opensearch.twig */
class __TwigTemplate_2f7d15363b79b5a88f586dfb302b84c6 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 1, $this->source); })()), "getBaseUrl", [], "method", false, false, false, 1)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 2
            yield "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<OpenSearchDescription xmlns=\"http://a9.com/-/spec/opensearch/1.1/\" xmlns:referrer=\"http://a9.com/-/opensearch/extensions/referrer/\">
    <ShortName>";
            // line 4
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 4, $this->source); })()), "config", ["title"], "method", false, false, false, 4), "html", null, true);
            yield " (";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 4, $this->source); })()), "version", [], "any", false, false, false, 4), "html", null, true);
            yield ")</ShortName>
    <Description>";
            // line 5
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Searches"), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 5, $this->source); })()), "config", ["title"], "method", false, false, false, 5), "html", null, true);
            yield " (";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 5, $this->source); })()), "version", [], "any", false, false, false, 5), "html", null, true);
            yield ")</Description>
    <Tags>";
            // line 6
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 6, $this->source); })()), "config", ["title"], "method", false, false, false, 6), "html", null, true);
            yield "</Tags>
    ";
            // line 7
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 7, $this->source); })()), "config", ["favicon"], "method", false, false, false, 7)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 8
                yield "<Image height=\"16\" width=\"16\" type=\"image/x-icon\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 8, $this->source); })()), "config", ["favicon"], "method", false, false, false, 8), "html", null, true);
                yield "</Image>
    ";
            }
            // line 10
            yield "<Url type=\"text/html\" method=\"GET\" template=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 10, $this->source); })()), "getBaseUrl", [], "method", false, false, false, 10), ["%version%" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 10, $this->source); })()), "version", [], "any", false, false, false, 10)]) . "/search.html?search={searchTerms}&utm_source={referrer:source?}"), "html", null, true);
            yield "\"/>
    <InputEncoding>UTF-8</InputEncoding>
    <AdultContent>false</AdultContent>
</OpenSearchDescription>
";
        }
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "opensearch.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  74 => 10,  68 => 8,  66 => 7,  62 => 6,  54 => 5,  48 => 4,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% if project.getBaseUrl() -%}
<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<OpenSearchDescription xmlns=\"http://a9.com/-/spec/opensearch/1.1/\" xmlns:referrer=\"http://a9.com/-/opensearch/extensions/referrer/\">
    <ShortName>{{ project.config('title') }} ({{ project.version }})</ShortName>
    <Description>{{ 'Searches'|trans }} {{ project.config('title') }} ({{ project.version }})</Description>
    <Tags>{{ project.config('title') }}</Tags>
    {% if project.config('favicon') -%}
        <Image height=\"16\" width=\"16\" type=\"image/x-icon\">{{ project.config('favicon') }}</Image>
    {% endif -%}
    <Url type=\"text/html\" method=\"GET\" template=\"{{ project.getBaseUrl()|replace({'%version%': project.version}) ~ '/search.html?search={searchTerms}&utm_source={referrer:source?}' }}\"/>
    <InputEncoding>UTF-8</InputEncoding>
    <AdultContent>false</AdultContent>
</OpenSearchDescription>
{% endif %}
", "opensearch.twig", "/Users/yuvisingh1265/Documents/GitHub/Studyroom-platform/vendor/code-lts/doctum/src/Resources/themes/default/opensearch.twig");
    }
}
