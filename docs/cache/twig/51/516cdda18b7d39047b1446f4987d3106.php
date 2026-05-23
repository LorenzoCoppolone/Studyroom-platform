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

/* doc-index.twig */
class __TwigTemplate_d74f80974a33c89538b6e5641f00ceea extends Template
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
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Index");
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
        yield "doc-index";
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
        yield "
    <div class=\"page-header\">
        <h1>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Index");
        // line 9
        yield "</h1>
    </div>

    <ul class=\"pagination\">
        ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(range("A", "Z"));
        foreach ($context['_seq'] as $context["_key"] => $context["letter"]) {
            // line 14
            yield "            ";
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), $context["letter"], [], "array", true, true, false, 14) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["items"]) || array_key_exists("items", $context) ? $context["items"] : (function () { throw new RuntimeError('Variable "items" does not exist.', 14, $this->source); })()), $context["letter"], [], "array", false, false, false, 14)) > 1))) {
                // line 15
                yield "                <li><a href=\"#letter";
                yield $context["letter"];
                yield "\">";
                yield $context["letter"];
                yield "</a></li>
            ";
            } else {
                // line 17
                yield "                <li class=\"disabled\"><a href=\"#letter";
                yield $context["letter"];
                yield "\">";
                yield $context["letter"];
                yield "</a></li>
            ";
            }
            // line 19
            yield "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['letter'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        yield "    </ul>

    ";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["items"]) || array_key_exists("items", $context) ? $context["items"] : (function () { throw new RuntimeError('Variable "items" does not exist.', 22, $this->source); })()));
        foreach ($context['_seq'] as $context["letter"] => $context["elements"]) {
            // line 23
            yield "<h2 id=\"letter";
            yield $context["letter"];
            yield "\">";
            yield $context["letter"];
            yield "</h2>
        <dl id=\"index";
            // line 24
            yield $context["letter"];
            yield "\">";
            // line 25
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["elements"]);
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 26
                $context["type"] = CoreExtension::getAttribute($this->env, $this->source, $context["element"], 0, [], "array", false, false, false, 26);
                // line 27
                $context["value"] = CoreExtension::getAttribute($this->env, $this->source, $context["element"], 1, [], "array", false, false, false, 27);
                // line 28
                if (("class" == (isset($context["type"]) || array_key_exists("type", $context) ? $context["type"] : (function () { throw new RuntimeError('Variable "type" does not exist.', 28, $this->source); })()))) {
                    // line 29
                    yield "<dt>";
                    yield $macros["_v0"]->getTemplateForMacro("macro_class_link", $context, 29, $this->getSourceContext())->macro_class_link(...[(isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 29, $this->source); })())]);
                    if ((($tmp = (isset($context["has_namespaces"]) || array_key_exists("has_namespaces", $context) ? $context["has_namespaces"] : (function () { throw new RuntimeError('Variable "has_namespaces" does not exist.', 29, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield " &mdash; <em>";
                        yield Twig\Extension\CoreExtension::sprintf(\Wdes\phpI18nL10n\Launcher::gettext("Class in namespace %s"), $macros["_v0"]->getTemplateForMacro("macro_namespace_link", $context, 30, $this->getSourceContext())->macro_namespace_link(...[CoreExtension::getAttribute($this->env, $this->source,                         // line 30
(isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 30, $this->source); })()), "namespace", [], "any", false, false, false, 30)]));
                    }
                    // line 31
                    yield "</em></dt>
                    <dd>";
                    // line 32
                    yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, (isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 32, $this->source); })()), "shortdesc", [], "any", false, false, false, 32), (isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 32, $this->source); })())));
                    yield "</dd>";
                } elseif (("method" ==                 // line 33
(isset($context["type"]) || array_key_exists("type", $context) ? $context["type"] : (function () { throw new RuntimeError('Variable "type" does not exist.', 33, $this->source); })()))) {
                    // line 34
                    yield "<dt>";
                    yield $macros["_v0"]->getTemplateForMacro("macro_method_link", $context, 34, $this->getSourceContext())->macro_method_link(...[(isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 34, $this->source); })())]);
                    yield "() &mdash; <em>";
                    yield Twig\Extension\CoreExtension::sprintf(\Wdes\phpI18nL10n\Launcher::gettext("Method in class %s"), $macros["_v0"]->getTemplateForMacro("macro_class_link", $context, 35, $this->getSourceContext())->macro_class_link(...[CoreExtension::getAttribute($this->env, $this->source,                     // line 35
(isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 35, $this->source); })()), "class", [], "any", false, false, false, 35)]));
                    // line 36
                    yield "</em></dt>
                    <dd>";
                    // line 37
                    yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, (isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 37, $this->source); })()), "shortdesc", [], "any", false, false, false, 37), CoreExtension::getAttribute($this->env, $this->source, (isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 37, $this->source); })()), "class", [], "any", false, false, false, 37)));
                    yield "</dd>";
                } elseif (("property" ==                 // line 38
(isset($context["type"]) || array_key_exists("type", $context) ? $context["type"] : (function () { throw new RuntimeError('Variable "type" does not exist.', 38, $this->source); })()))) {
                    // line 39
                    yield "<dt>\$";
                    yield $macros["_v0"]->getTemplateForMacro("macro_property_link", $context, 39, $this->getSourceContext())->macro_property_link(...[(isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 39, $this->source); })())]);
                    yield " &mdash; <em>";
                    yield Twig\Extension\CoreExtension::sprintf(\Wdes\phpI18nL10n\Launcher::gettext("Property in class %s"), $macros["_v0"]->getTemplateForMacro("macro_class_link", $context, 40, $this->getSourceContext())->macro_class_link(...[CoreExtension::getAttribute($this->env, $this->source,                     // line 40
(isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 40, $this->source); })()), "class", [], "any", false, false, false, 40)]));
                    // line 41
                    yield "</em></dt>
                    <dd>";
                    // line 42
                    yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, (isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 42, $this->source); })()), "shortdesc", [], "any", false, false, false, 42), CoreExtension::getAttribute($this->env, $this->source, (isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 42, $this->source); })()), "class", [], "any", false, false, false, 42)));
                    yield "</dd>";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['element'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 45
            yield "        </dl>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['letter'], $context['elements'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "doc-index.twig";
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
        return array (  202 => 45,  194 => 42,  191 => 41,  189 => 40,  185 => 39,  183 => 38,  180 => 37,  177 => 36,  175 => 35,  171 => 34,  169 => 33,  166 => 32,  163 => 31,  160 => 30,  155 => 29,  153 => 28,  151 => 27,  149 => 26,  145 => 25,  142 => 24,  135 => 23,  131 => 22,  127 => 20,  121 => 19,  113 => 17,  105 => 15,  102 => 14,  98 => 13,  92 => 9,  87 => 7,  80 => 6,  69 => 4,  56 => 3,  51 => 1,  49 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layout/layout.twig\" %}
{% from \"macros.twig\" import class_link, namespace_link, method_link, property_link %}
{% block title %}{% trans 'Index' %} | {{ parent() }}{% endblock %}
{% block body_class 'doc-index' %}

{% block page_content %}

    <div class=\"page-header\">
        <h1>{% trans 'Index' %}</h1>
    </div>

    <ul class=\"pagination\">
        {% for letter in 'A'..'Z' %}
            {% if items[letter] is defined and items[letter]|length > 1 %}
                <li><a href=\"#letter{{ letter|raw }}\">{{ letter|raw }}</a></li>
            {% else %}
                <li class=\"disabled\"><a href=\"#letter{{ letter|raw }}\">{{ letter|raw }}</a></li>
            {% endif %}
        {% endfor %}
    </ul>

    {% for letter, elements in items -%}
        <h2 id=\"letter{{ letter|raw }}\">{{ letter|raw }}</h2>
        <dl id=\"index{{ letter|raw }}\">
            {%- for element in elements %}
                {%- set type = element[0] %}
                {%- set value = element[1] %}
                {%- if 'class' == type -%}
                    <dt>{{ class_link(value) }}{% if has_namespaces %} &mdash; <em>{{'Class in namespace %s'|trans|format(
                        namespace_link(value.namespace)
                    )|raw}}{% endif %}</em></dt>
                    <dd>{{ value.shortdesc|desc(value)|md_to_html }}</dd>
                {%- elseif 'method' == type -%}
                    <dt>{{ method_link(value) }}() &mdash; <em>{{ 'Method in class %s'|trans|format(
                        class_link(value.class)
                    )|raw }}</em></dt>
                    <dd>{{ value.shortdesc|desc(value.class)|md_to_html }}</dd>
                {%- elseif 'property' == type -%}
                    <dt>\${{ property_link(value) }} &mdash; <em>{{ 'Property in class %s'|trans|format(
                        class_link(value.class)
                    )|raw}}</em></dt>
                    <dd>{{ value.shortdesc|desc(value.class)|md_to_html }}</dd>
                {%- endif %}
            {%- endfor %}
        </dl>
    {%- endfor %}
{% endblock %}
", "doc-index.twig", "/Users/yuvisingh1265/Documents/GitHub/Studyroom-platform/vendor/code-lts/doctum/src/Resources/themes/default/doc-index.twig");
    }
}
