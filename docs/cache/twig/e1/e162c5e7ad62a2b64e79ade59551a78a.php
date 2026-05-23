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

/* traits.twig */
class __TwigTemplate_55ad6fef1cf63770c9804c310c9c1a69 extends Template
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
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Traits");
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
        yield "traits";
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
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Traits");
        // line 8
        yield "</h1>
    </div>

    <div class=\"container-fluid underlined\">
        ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["classes"]) || array_key_exists("classes", $context) ? $context["classes"] : (function () { throw new RuntimeError('Variable "classes" does not exist.', 12, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
            // line 13
            yield "            ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["class"], "trait", [], "any", false, false, false, 13)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 14
                yield "                <div class=\"row\">
                    <div class=\"col-md-6\">
                        ";
                // line 16
                yield $macros["_v0"]->getTemplateForMacro("macro_class_link", $context, 16, $this->getSourceContext())->macro_class_link(...[$context["class"], true]);
                yield "
                    </div>
                    <div class=\"col-md-6\">
                        ";
                // line 19
                yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, $context["class"], "shortdesc", [], "any", false, false, false, 19), $context["class"]));
                yield "
                    </div>
                </div>
            ";
            }
            // line 23
            yield "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['class'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        yield "    </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "traits.twig";
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
        return array (  127 => 24,  121 => 23,  114 => 19,  108 => 16,  104 => 14,  101 => 13,  97 => 12,  91 => 8,  87 => 7,  80 => 6,  69 => 4,  56 => 3,  51 => 1,  49 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layout/layout.twig\" %}
{% from \"macros.twig\" import class_link %}
{% block title %}{% trans 'Traits' %} | {{ parent() }}{% endblock %}
{% block body_class 'traits' %}

{% block page_content %}
    <div class=\"page-header\">
        <h1>{% trans 'Traits' %}</h1>
    </div>

    <div class=\"container-fluid underlined\">
        {% for class in classes %}
            {% if class.trait %}
                <div class=\"row\">
                    <div class=\"col-md-6\">
                        {{ class_link(class, true) }}
                    </div>
                    <div class=\"col-md-6\">
                        {{ class.shortdesc|desc(class)|md_to_html }}
                    </div>
                </div>
            {% endif %}
        {% endfor %}
    </div>
{% endblock %}
", "traits.twig", "/Users/yuvisingh1265/Documents/GitHub/Studyroom-platform/vendor/code-lts/doctum/src/Resources/themes/default/traits.twig");
    }
}
