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

/* namespaces.twig */
class __TwigTemplate_8c383c774ea5d7a4923af9eee2f8aede extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body_class' => [$this, 'block_body_class'],
            'page_content' => [$this, 'block_page_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layout/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 2
        $macros["_v0"] = $this->macros["_v0"] = $this->load("macros.twig", 2)->unwrap();
        // line 1
        $this->parent = $this->load("layout/layout.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Namespaces");
        yield " | ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "namespaces";
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "    <div class=\"page-header\">
        <h1>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Namespaces");
        // line 8
        yield "</h1>
    </div>

    ";
        // line 11
        if ((($tmp = (isset($context["namespaces"]) || array_key_exists("namespaces", $context) ? $context["namespaces"] : (function () { throw new RuntimeError('Variable "namespaces" does not exist.', 11, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 12
            yield "        <div class=\"namespaces clearfix\">
            ";
            // line 13
            $context["last_name"] = "";
            // line 14
            yield "            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["namespaces"]) || array_key_exists("namespaces", $context) ? $context["namespaces"] : (function () { throw new RuntimeError('Variable "namespaces" does not exist.', 14, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["namespace"]) {
                // line 15
                yield "                ";
                $context["top_level"] = Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), $context["namespace"], "\\"));
                // line 16
                yield "                ";
                if (((isset($context["top_level"]) || array_key_exists("top_level", $context) ? $context["top_level"] : (function () { throw new RuntimeError('Variable "top_level" does not exist.', 16, $this->source); })()) != (isset($context["last_name"]) || array_key_exists("last_name", $context) ? $context["last_name"] : (function () { throw new RuntimeError('Variable "last_name" does not exist.', 16, $this->source); })()))) {
                    // line 17
                    yield "                    ";
                    if ((($tmp = (isset($context["last_name"]) || array_key_exists("last_name", $context) ? $context["last_name"] : (function () { throw new RuntimeError('Variable "last_name" does not exist.', 17, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield "</ul></div>";
                    }
                    // line 18
                    yield "                    <div class=\"namespace-container\">
                        <h2>";
                    // line 19
                    yield (isset($context["top_level"]) || array_key_exists("top_level", $context) ? $context["top_level"] : (function () { throw new RuntimeError('Variable "top_level" does not exist.', 19, $this->source); })());
                    yield "</h2>
                        <ul>
                    ";
                    // line 21
                    $context["last_name"] = (isset($context["top_level"]) || array_key_exists("top_level", $context) ? $context["top_level"] : (function () { throw new RuntimeError('Variable "top_level" does not exist.', 21, $this->source); })());
                    // line 22
                    yield "                ";
                }
                // line 23
                yield "                <li>";
                yield $macros["_v0"]->getTemplateForMacro("macro_namespace_link", $context, 23, $this->getSourceContext())->macro_namespace_link(...[$context["namespace"]]);
                yield "</li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['namespace'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            yield "                </ul>
            </div>
        </div>
    ";
        }
        // line 29
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "namespaces.twig";
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
        return array (  147 => 29,  141 => 25,  132 => 23,  129 => 22,  127 => 21,  122 => 19,  119 => 18,  114 => 17,  111 => 16,  108 => 15,  103 => 14,  101 => 13,  98 => 12,  96 => 11,  91 => 8,  87 => 7,  80 => 6,  69 => 4,  56 => 3,  51 => 1,  49 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layout/layout.twig\" %}
{% from \"macros.twig\" import namespace_link %}
{% block title %}{% trans 'Namespaces' %} | {{ parent() }}{% endblock %}
{% block body_class 'namespaces' %}

{% block page_content %}
    <div class=\"page-header\">
        <h1>{% trans 'Namespaces' %}</h1>
    </div>

    {% if namespaces %}
        <div class=\"namespaces clearfix\">
            {% set last_name = '' %}
            {% for namespace in namespaces %}
                {% set top_level = namespace|split('\\\\')|first %}
                {% if top_level != last_name %}
                    {% if last_name %}</ul></div>{% endif %}
                    <div class=\"namespace-container\">
                        <h2>{{ top_level|raw }}</h2>
                        <ul>
                    {% set last_name = top_level %}
                {% endif %}
                <li>{{ namespace_link(namespace) }}</li>
            {% endfor %}
                </ul>
            </div>
        </div>
    {% endif %}

{% endblock %}
", "namespaces.twig", "/Users/yuvisingh1265/Documents/GitHub/Studyroom-platform/vendor/code-lts/doctum/src/Resources/themes/default/namespaces.twig");
    }
}
