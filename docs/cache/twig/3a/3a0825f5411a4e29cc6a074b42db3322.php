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

/* layout/base.twig */
class __TwigTemplate_9b0314803766200f58e1728eee6cc0b0 extends Template
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
            'title' => [$this, 'block_title'],
            'head' => [$this, 'block_head'],
            'html' => [$this, 'block_html'],
            'body_class' => [$this, 'block_body_class'],
            'page_id' => [$this, 'block_page_id'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 2, $this->source); })()), "config", ["language"], "method", false, false, false, 2), "html", null, true);
        yield "\">
<head>
    <meta charset=\"UTF-8\" />
    <meta name=\"robots\" content=\"index, follow, all\" />
    <title>";
        // line 6
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>

    ";
        // line 8
        yield from $this->unwrap()->yieldBlock('head', $context, $blocks);
        // line 21
        yield "
";
        // line 22
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 22, $this->source); })()), "config", ["favicon"], "method", false, false, false, 22)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 23
            yield "        <link rel=\"shortcut icon\" href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 23, $this->source); })()), "config", ["favicon"], "method", false, false, false, 23), "html", null, true);
            yield "\" />";
        }
        // line 25
        yield "
    ";
        // line 26
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 26, $this->source); })()), "getBaseUrl", [], "method", false, false, false, 26)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 27
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 27, $this->source); })()), "versions", [], "any", false, false, false, 27));
            foreach ($context['_seq'] as $context["_key"] => $context["version"]) {
                // line 28
                yield "<link rel=\"search\"
    ";
                // line 29
                yield "      type=\"application/opensearchdescription+xml\"
    ";
                // line 30
                yield "      href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 30, $this->source); })()), "getBaseUrl", [], "method", false, false, false, 30), ["%version%" => $context["version"]]), "html", null, true);
                yield "/opensearch.xml\"
    ";
                // line 31
                yield "      title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 31, $this->source); })()), "config", ["title"], "method", false, false, false, 31), "html", null, true);
                yield " (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["version"], "html", null, true);
                yield ")\" />
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['version'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 34
        yield "</head>

";
        // line 36
        yield from $this->unwrap()->yieldBlock('html', $context, $blocks);
        // line 41
        yield "
</html>
";
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 6, $this->source); })()), "config", ["title"], "method", false, false, false, 6), "html", null, true);
        yield from [];
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 9
        yield "        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "css/bootstrap.min.css"), "html", null, true);
        yield "\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "css/bootstrap-theme.min.css"), "html", null, true);
        yield "\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "css/doctum.css"), "html", null, true);
        yield "\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "fonts/doctum-font.css"), "html", null, true);
        yield "\">
        <script src=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "js/jquery-3.5.1.slim.min.js"), "html", null, true);
        yield "\"></script>
        <script async defer src=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "doctum.js"), "html", null, true);
        yield "\"></script>
        <script async defer src=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "js/bootstrap.min.js"), "html", null, true);
        yield "\"></script>
        <script async defer src=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "js/autocomplete.min.js"), "html", null, true);
        yield "\"></script>
        <meta name=\"MobileOptimized\" content=\"width\">
        <meta name=\"HandheldFriendly\" content=\"true\">
        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1,maximum-scale=1\">";
        yield from [];
    }

    // line 36
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_html(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 37
        yield "    <body id=\"";
        yield from $this->unwrap()->yieldBlock('body_class', $context, $blocks);
        yield "\" data-name=\"";
        yield from $this->unwrap()->yieldBlock('page_id', $context, $blocks);
        yield "\" data-root-path=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["root_path"]) || array_key_exists("root_path", $context) ? $context["root_path"] : (function () { throw new RuntimeError('Variable "root_path" does not exist.', 37, $this->source); })()), "html", null, true);
        yield "\" data-search-index-url=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "doctum-search.json"), "html", null, true);
        yield "\">
        ";
        // line 38
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 39
        yield "    </body>
";
        yield from [];
    }

    // line 37
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "";
        yield from [];
    }

    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_id(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "";
        yield from [];
    }

    // line 38
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "layout/base.twig";
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
        return array (  224 => 38,  203 => 37,  197 => 39,  195 => 38,  184 => 37,  177 => 36,  168 => 16,  164 => 15,  160 => 14,  156 => 13,  152 => 12,  148 => 11,  144 => 10,  139 => 9,  132 => 8,  121 => 6,  114 => 41,  112 => 36,  108 => 34,  96 => 31,  91 => 30,  88 => 29,  85 => 28,  80 => 27,  78 => 26,  75 => 25,  70 => 23,  68 => 22,  65 => 21,  63 => 8,  58 => 6,  51 => 2,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"{{ project.config('language') }}\">
<head>
    <meta charset=\"UTF-8\" />
    <meta name=\"robots\" content=\"index, follow, all\" />
    <title>{% block title project.config('title') %}</title>

    {% block head %}
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ path('css/bootstrap.min.css') }}\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ path('css/bootstrap-theme.min.css') }}\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ path('css/doctum.css') }}\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ path('fonts/doctum-font.css') }}\">
        <script src=\"{{ path('js/jquery-3.5.1.slim.min.js') }}\"></script>
        <script async defer src=\"{{ path('doctum.js') }}\"></script>
        <script async defer src=\"{{ path('js/bootstrap.min.js') }}\"></script>
        <script async defer src=\"{{ path('js/autocomplete.min.js') }}\"></script>
        <meta name=\"MobileOptimized\" content=\"width\">
        <meta name=\"HandheldFriendly\" content=\"true\">
        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1,maximum-scale=1\">
    {%- endblock %}

{##}{% if project.config('favicon') %}
        <link rel=\"shortcut icon\" href=\"{{ project.config('favicon') }}\" />
    {%- endif %}

    {% if project.getBaseUrl() %}
    {#  #}{%- for version in project.versions -%}
    {#  #}<link rel=\"search\"
    {#  #}      type=\"application/opensearchdescription+xml\"
    {#  #}      href=\"{{ project.getBaseUrl()|replace({'%version%': version}) }}/opensearch.xml\"
    {#  #}      title=\"{{ project.config('title') }} ({{ version }})\" />
    {#  #}{% endfor -%}
    {% endif %}
</head>

{% block html %}
    <body id=\"{% block body_class '' %}\" data-name=\"{% block page_id '' %}\" data-root-path=\"{{ root_path }}\" data-search-index-url=\"{{ path('doctum-search.json') }}\">
        {% block content '' %}
    </body>
{% endblock %}

</html>
", "layout/base.twig", "/Users/yuvisingh1265/Documents/GitHub/Studyroom-platform/vendor/code-lts/doctum/src/Resources/themes/default/layout/base.twig");
    }
}
