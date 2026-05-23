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

/* namespace.twig */
class __TwigTemplate_17ca841b3fad104316ed96f38e964196 extends Template
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
            'page_id' => [$this, 'block_page_id'],
            'below_menu' => [$this, 'block_below_menu'],
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
        yield ((((isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 3, $this->source); })()) == "")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Doctum\Tree::getGlobalNamespaceName(), "html", null, true)) : ((isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 3, $this->source); })())));
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
        yield "namespace";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_id(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("namespace:" . Twig\Extension\CoreExtension::replace(((((isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 5, $this->source); })()) == "")) ? (Doctum\Tree::getGlobalNamespacePageName()) : ((isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 5, $this->source); })()))), ["\\" => "_"])), "html", null, true);
        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_below_menu(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 8
        yield "    <div class=\"namespace-breadcrumbs\">
        <ol class=\"breadcrumb\">
            <li><span class=\"label label-default\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Namespace");
        // line 10
        yield "</span></li>
            ";
        // line 11
        yield $macros["_v0"]->getTemplateForMacro("macro_breadcrumbs", $context, 11, $this->getSourceContext())->macro_breadcrumbs(...[(isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 11, $this->source); })())]);
        yield "
        </ol>
    </div>
";
        yield from [];
    }

    // line 16
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 17
        yield "
    <div class=\"page-header\">
        <h1>";
        // line 19
        yield ((((isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 19, $this->source); })()) == "")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Doctum\Tree::getGlobalNamespaceName(), "html", null, true)) : ((isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 19, $this->source); })())));
        yield "</h1>
    </div>

    ";
        // line 22
        if ((($tmp = (isset($context["subnamespaces"]) || array_key_exists("subnamespaces", $context) ? $context["subnamespaces"] : (function () { throw new RuntimeError('Variable "subnamespaces" does not exist.', 22, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 23
            yield "        <h2>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Namespaces");
            yield "</h2>
        <div class=\"namespace-list\">
            ";
            // line 25
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["subnamespaces"]) || array_key_exists("subnamespaces", $context) ? $context["subnamespaces"] : (function () { throw new RuntimeError('Variable "subnamespaces" does not exist.', 25, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["ns"]) {
                yield $macros["_v0"]->getTemplateForMacro("macro_namespace_link", $context, 25, $this->getSourceContext())->macro_namespace_link(...[$context["ns"]]);
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['ns'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            yield "        </div>
    ";
        }
        // line 28
        yield "
    ";
        // line 29
        if ((($tmp = (isset($context["classes"]) || array_key_exists("classes", $context) ? $context["classes"] : (function () { throw new RuntimeError('Variable "classes" does not exist.', 29, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 30
            yield "        <h2>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Classes");
            yield "</h2>";
            // line 31
            yield $macros["_v0"]->getTemplateForMacro("macro_render_classes", $context, 31, $this->getSourceContext())->macro_render_classes(...[(isset($context["classes"]) || array_key_exists("classes", $context) ? $context["classes"] : (function () { throw new RuntimeError('Variable "classes" does not exist.', 31, $this->source); })())]);
        }
        // line 33
        yield "
    ";
        // line 34
        if ((($tmp = (isset($context["interfaces"]) || array_key_exists("interfaces", $context) ? $context["interfaces"] : (function () { throw new RuntimeError('Variable "interfaces" does not exist.', 34, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 35
            yield "        <h2>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Interfaces");
            yield "</h2>";
            // line 36
            yield $macros["_v0"]->getTemplateForMacro("macro_render_classes", $context, 36, $this->getSourceContext())->macro_render_classes(...[(isset($context["interfaces"]) || array_key_exists("interfaces", $context) ? $context["interfaces"] : (function () { throw new RuntimeError('Variable "interfaces" does not exist.', 36, $this->source); })())]);
        }
        // line 38
        yield "
    ";
        // line 39
        if ((($tmp = (isset($context["functions"]) || array_key_exists("functions", $context) ? $context["functions"] : (function () { throw new RuntimeError('Variable "functions" does not exist.', 39, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 40
            yield "        <h2>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Functions");
            yield "</h2>

        <div class=\"container-fluid underlined\">
            ";
            // line 43
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["functions"]) || array_key_exists("functions", $context) ? $context["functions"] : (function () { throw new RuntimeError('Variable "functions" does not exist.', 43, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["function"]) {
                // line 44
                yield "                <div class=\"row\" id=\"function_";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["function"], "name", [], "any", false, false, false, 44);
                yield "\">
                    <div class=\"col-md-2 type\">
                        ";
                // line 46
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["function"], "isStatic", [], "method", false, false, false, 46)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "static";
                }
                // line 47
                yield "                        ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["function"], "isProtected", [], "method", false, false, false, 47)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "protected";
                }
                // line 48
                yield "                        ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["function"], "isPrivate", [], "method", false, false, false, 48)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "private";
                }
                // line 49
                yield "                        ";
                yield $macros["_v0"]->getTemplateForMacro("macro_hint_link", $context, 49, $this->getSourceContext())->macro_hint_link(...[CoreExtension::getAttribute($this->env, $this->source, $context["function"], "hint", [], "any", false, false, false, 49)]);
                yield "
                    </div>
                    <div class=\"col-md-8\">
                        ";
                // line 52
                yield CoreExtension::getAttribute($this->env, $this->source, $context["function"], "name", [], "any", false, false, false, 52);
                // line 53
                yield $macros["_v0"]->getTemplateForMacro("macro_function_parameters_signature", $context, 53, $this->getSourceContext())->macro_function_parameters_signature(...[$context["function"]]);
                // line 54
                yield "<br>
                        ";
                // line 55
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["function"], "isInternal", [], "method", false, false, false, 55)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "<span class=\"label label-warning\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("internal");
                    yield "</span>";
                }
                // line 56
                yield "                        ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["function"], "isDeprecated", [], "method", false, false, false, 56)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "<span class=\"label label-danger\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("deprecated");
                    yield "</span>";
                }
                // line 57
                yield "                        ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["function"], "hasSince", [], "method", false, false, false, 57)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 58
                    yield "                            <i>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Since:"), "html", null, true);
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["function"], "getSince", [], "method", false, false, false, 58), "html", null, true);
                    yield "</i>
                            <br>
                        ";
                }
                // line 61
                yield "                        ";
                if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["function"], "shortdesc", [], "any", false, false, false, 61)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 62
                    yield "                            <p class=\"no-description\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("No description");
                    yield "</p>
                        ";
                } else {
                    // line 64
                    yield "                            <p>";
                    yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, $context["function"], "shortdesc", [], "any", false, false, false, 64), $context["function"]));
                    yield "</p>";
                }
                // line 66
                yield "                    </div>
                    <div class=\"col-md-2\">
                        <div class=\"location\">";
                // line 69
                if ((($tmp =  !(CoreExtension::getAttribute($this->env, $this->source, $context["function"], "namespace", [], "any", false, false, false, 69) === (isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 69, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 70
                    yield "<em><a href=\"";
                    yield $this->extensions['Doctum\Renderer\TwigExtension']->pathForFunction($context, $context["function"]);
                    yield "\">";
                    yield $context["function"];
                    yield "</a></em>";
                }
                // line 71
                yield $macros["_v0"]->getTemplateForMacro("macro_method_source_link", $context, 71, $this->getSourceContext())->macro_method_source_link(...[$context["function"]]);
                yield "
                        </div>
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['function'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 76
            yield "        </div>
    ";
        }
        // line 78
        yield "
    ";
        // line 79
        if ((($tmp = (isset($context["exceptions"]) || array_key_exists("exceptions", $context) ? $context["exceptions"] : (function () { throw new RuntimeError('Variable "exceptions" does not exist.', 79, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 80
            yield "        <h2>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Exceptions");
            yield "</h2>";
            // line 81
            yield $macros["_v0"]->getTemplateForMacro("macro_render_classes", $context, 81, $this->getSourceContext())->macro_render_classes(...[(isset($context["exceptions"]) || array_key_exists("exceptions", $context) ? $context["exceptions"] : (function () { throw new RuntimeError('Variable "exceptions" does not exist.', 81, $this->source); })())]);
        }
        // line 83
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "namespace.twig";
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
        return array (  308 => 83,  305 => 81,  301 => 80,  299 => 79,  296 => 78,  292 => 76,  281 => 71,  274 => 70,  272 => 69,  268 => 66,  263 => 64,  257 => 62,  254 => 61,  245 => 58,  242 => 57,  235 => 56,  229 => 55,  226 => 54,  224 => 53,  222 => 52,  215 => 49,  210 => 48,  205 => 47,  201 => 46,  195 => 44,  191 => 43,  184 => 40,  182 => 39,  179 => 38,  176 => 36,  172 => 35,  170 => 34,  167 => 33,  164 => 31,  160 => 30,  158 => 29,  155 => 28,  151 => 26,  142 => 25,  136 => 23,  134 => 22,  128 => 19,  124 => 17,  117 => 16,  108 => 11,  105 => 10,  100 => 8,  93 => 7,  82 => 5,  71 => 4,  58 => 3,  53 => 1,  51 => 2,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layout/layout.twig\" %}
{% from \"macros.twig\" import breadcrumbs, render_classes, class_link, namespace_link, hint_link, deprecated, function_parameters_signature, method_source_link %}
{% block title %}{{ namespace == '' ? global_namespace_name() : namespace|raw }} | {{ parent() }}{% endblock %}
{% block body_class 'namespace' %}
{% block page_id 'namespace:' ~ ((namespace == '' ? global_namespace_page_name() : namespace)|replace({'\\\\': '_'})) %}

{% block below_menu %}
    <div class=\"namespace-breadcrumbs\">
        <ol class=\"breadcrumb\">
            <li><span class=\"label label-default\">{% trans 'Namespace' %}</span></li>
            {{ breadcrumbs(namespace) }}
        </ol>
    </div>
{% endblock %}

{% block page_content %}

    <div class=\"page-header\">
        <h1>{{ namespace == '' ? global_namespace_name() : namespace|raw }}</h1>
    </div>

    {% if subnamespaces %}
        <h2>{% trans 'Namespaces' %}</h2>
        <div class=\"namespace-list\">
            {% for ns in subnamespaces %}{{ namespace_link(ns) }}{% endfor %}
        </div>
    {% endif %}

    {% if classes %}
        <h2>{% trans 'Classes' %}</h2>
        {{- render_classes(classes) -}}
    {% endif %}

    {% if interfaces %}
        <h2>{% trans 'Interfaces' %}</h2>
        {{- render_classes(interfaces) -}}
    {% endif %}

    {% if functions %}
        <h2>{% trans 'Functions' %}</h2>

        <div class=\"container-fluid underlined\">
            {% for function in functions %}
                <div class=\"row\" id=\"function_{{ function.name|raw }}\">
                    <div class=\"col-md-2 type\">
                        {% if function.isStatic() %}static{% endif %}
                        {% if function.isProtected() %}protected{% endif %}
                        {% if function.isPrivate() %}private{% endif %}
                        {{ hint_link(function.hint) }}
                    </div>
                    <div class=\"col-md-8\">
                        {{ function.name|raw }}
                        {{- function_parameters_signature(function) -}}
                        <br>
                        {% if function.isInternal() %}<span class=\"label label-warning\">{% trans 'internal' %}</span>{% endif %}
                        {% if function.isDeprecated() %}<span class=\"label label-danger\">{% trans 'deprecated' %}</span>{% endif %}
                        {% if function.hasSince() %}
                            <i>{{ 'Since:'|trans }} {{ function.getSince() }}</i>
                            <br>
                        {% endif %}
                        {% if not function.shortdesc %}
                            <p class=\"no-description\">{% trans 'No description' %}</p>
                        {% else %}
                            <p>{{ function.shortdesc|desc(function)|md_to_html }}</p>
                        {%- endif %}
                    </div>
                    <div class=\"col-md-2\">
                        <div class=\"location\">
                        {%- if function.namespace is not same as(namespace) -%}
                            <em><a href=\"{{ function_path(function) }}\">{{ function|raw }}</a></em>
                        {%- endif -%}{{ method_source_link(function) }}
                        </div>
                    </div>
                </div>
            {% endfor %}
        </div>
    {% endif %}

    {% if exceptions %}
        <h2>{% trans 'Exceptions' %}</h2>
        {{- render_classes(exceptions) -}}
    {% endif %}

{% endblock %}
", "namespace.twig", "/Users/yuvisingh1265/Documents/GitHub/Studyroom-platform/vendor/code-lts/doctum/src/Resources/themes/default/namespace.twig");
    }
}
