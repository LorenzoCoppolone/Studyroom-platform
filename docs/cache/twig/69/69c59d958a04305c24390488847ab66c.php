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

/* class.twig */
class __TwigTemplate_390930321cc3ee05516cb081c3d94461 extends Template
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
            'class_signature' => [$this, 'block_class_signature'],
            'method_signature' => [$this, 'block_method_signature'],
            'method_parameters_signature' => [$this, 'block_method_parameters_signature'],
            'parameters' => [$this, 'block_parameters'],
            'return' => [$this, 'block_return'],
            'exceptions' => [$this, 'block_exceptions'],
            'examples' => [$this, 'block_examples'],
            'see' => [$this, 'block_see'],
            'constants' => [$this, 'block_constants'],
            'properties' => [$this, 'block_properties'],
            'methods' => [$this, 'block_methods'],
            'methods_details' => [$this, 'block_methods_details'],
            'method' => [$this, 'block_method'],
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
        yield (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 3, $this->source); })());
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
        yield "class";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_id(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("class:" . Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 5, $this->source); })()), "name", [], "any", false, false, false, 5), ["\\" => "_"])), "html", null, true);
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
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 8, $this->source); })()), "namespace", [], "any", false, false, false, 8)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 9
            yield "        <div class=\"namespace-breadcrumbs\">
            <ol class=\"breadcrumb\">
                <li><span class=\"label label-default\">";
            // line 11
            yield $macros["_v0"]->getTemplateForMacro("macro_class_category_name", $context, 11, $this->getSourceContext())->macro_class_category_name(...[CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 11, $this->source); })()), "getCategoryId", [], "method", false, false, false, 11)]);
            yield "</span></li>
                ";
            // line 12
            yield $macros["_v0"]->getTemplateForMacro("macro_breadcrumbs", $context, 12, $this->getSourceContext())->macro_breadcrumbs(...[CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 12, $this->source); })()), "namespace", [], "any", false, false, false, 12)]);
            // line 13
            yield "<li>";
            yield CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 13, $this->source); })()), "shortname", [], "any", false, false, false, 13);
            yield "</li>
            </ol>
        </div>
    ";
        }
        yield from [];
    }

    // line 19
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 20
        yield "
    <div class=\"page-header\">
        <h1>";
        // line 23
        yield Twig\Extension\CoreExtension::last($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 23, $this->source); })()), "name", [], "any", false, false, false, 23), "\\"));
        // line 24
        yield $macros["_v0"]->getTemplateForMacro("macro_deprecated", $context, 24, $this->getSourceContext())->macro_deprecated(...[(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 24, $this->source); })())]);
        yield "
            ";
        // line 25
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 25, $this->source); })()), "isReadOnly", [], "method", false, false, false, 25)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<small><span class=\"label label-primary\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("read-only");
            yield "</span></small>";
        }
        // line 26
        yield "</h1>
    </div>

    ";
        // line 29
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 29, $this->source); })()), "hasSince", [], "method", false, false, false, 29)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 30
            yield "        <i>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Since:"), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 30, $this->source); })()), "getSince", [], "method", false, false, false, 30), "html", null, true);
            yield "</i>
        <br>
    ";
        }
        // line 33
        yield "
    <p>";
        // line 34
        yield from         $this->unwrap()->yieldBlock("class_signature", $context, $blocks);
        yield "</p>

    ";
        // line 36
        yield $macros["_v0"]->getTemplateForMacro("macro_categories", $context, 36, $this->getSourceContext())->macro_categories(...[(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 36, $this->source); })())]);
        yield "
    ";
        // line 37
        yield $macros["_v0"]->getTemplateForMacro("macro_deprecations", $context, 37, $this->getSourceContext())->macro_deprecations(...[(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 37, $this->source); })())]);
        yield "
    ";
        // line 38
        yield $macros["_v0"]->getTemplateForMacro("macro_internals", $context, 38, $this->getSourceContext())->macro_internals(...[(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 38, $this->source); })())]);
        yield "

    ";
        // line 40
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 40, $this->source); })()), "shortdesc", [], "any", false, false, false, 40) || CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 40, $this->source); })()), "longdesc", [], "any", false, false, false, 40))) {
            // line 41
            yield "        <div class=\"description\">
            ";
            // line 42
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 42, $this->source); })()), "shortdesc", [], "any", false, false, false, 42)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 43
                yield "<p>";
                yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 43, $this->source); })()), "shortdesc", [], "any", false, false, false, 43), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 43, $this->source); })())));
                yield "</p>";
            }
            // line 45
            yield "            ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 45, $this->source); })()), "longdesc", [], "any", false, false, false, 45)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 46
                yield "<p>";
                yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 46, $this->source); })()), "longdesc", [], "any", false, false, false, 46), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 46, $this->source); })())));
                yield "</p>";
            }
            // line 48
            yield "        </div>
    ";
        }
        // line 50
        yield $macros["_v0"]->getTemplateForMacro("macro_todos", $context, 50, $this->getSourceContext())->macro_todos(...[(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 50, $this->source); })())]);
        // line 52
        if ((($tmp = (isset($context["traits"]) || array_key_exists("traits", $context) ? $context["traits"] : (function () { throw new RuntimeError('Variable "traits" does not exist.', 52, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 53
            yield "        <h2>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Traits");
            yield "</h2>

        ";
            // line 55
            yield $macros["_v0"]->getTemplateForMacro("macro_render_classes", $context, 55, $this->getSourceContext())->macro_render_classes(...[(isset($context["traits"]) || array_key_exists("traits", $context) ? $context["traits"] : (function () { throw new RuntimeError('Variable "traits" does not exist.', 55, $this->source); })())]);
            yield "
    ";
        }
        // line 57
        yield "
    ";
        // line 58
        if ((($tmp = (isset($context["constants"]) || array_key_exists("constants", $context) ? $context["constants"] : (function () { throw new RuntimeError('Variable "constants" does not exist.', 58, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 59
            yield "        <h2>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Constants");
            yield "</h2>";
            // line 61
            yield from             $this->unwrap()->yieldBlock("constants", $context, $blocks);
            yield "
    ";
        }
        // line 63
        yield "
    ";
        // line 64
        if ((($tmp = (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 64, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 65
            yield "        <h2>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Properties");
            yield "</h2>

        ";
            // line 67
            yield from             $this->unwrap()->yieldBlock("properties", $context, $blocks);
            yield "
    ";
        }
        // line 69
        yield "
    ";
        // line 70
        if ((($tmp = (isset($context["methods"]) || array_key_exists("methods", $context) ? $context["methods"] : (function () { throw new RuntimeError('Variable "methods" does not exist.', 70, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 71
            yield "        <h2>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Methods");
            yield "</h2>

        ";
            // line 73
            yield from             $this->unwrap()->yieldBlock("methods", $context, $blocks);
            yield "

        <h2>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Details");
            // line 75
            yield "</h2>

        ";
            // line 77
            yield from             $this->unwrap()->yieldBlock("methods_details", $context, $blocks);
            yield "
    ";
        }
        // line 79
        yield "
";
        yield from [];
    }

    // line 82
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_class_signature(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 83
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 83, $this->source); })()), "final", [], "any", false, false, false, 83)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "final ";
        }
        // line 84
        yield "    ";
        if (( !CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 84, $this->source); })()), "interface", [], "any", false, false, false, 84) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 84, $this->source); })()), "abstract", [], "any", false, false, false, 84))) {
            yield "abstract ";
        }
        // line 85
        yield "    ";
        yield $macros["_v0"]->getTemplateForMacro("macro_class_category_name", $context, 85, $this->getSourceContext())->macro_class_category_name(...[CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 85, $this->source); })()), "getCategoryId", [], "method", false, false, false, 85)]);
        yield "
    <strong>";
        // line 86
        yield CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 86, $this->source); })()), "shortname", [], "any", false, false, false, 86);
        yield "</strong>";
        // line 87
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 87, $this->source); })()), "parent", [], "any", false, false, false, 87)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 88
            yield "        ";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("extends");
            yield " ";
            yield $macros["_v0"]->getTemplateForMacro("macro_class_link", $context, 88, $this->getSourceContext())->macro_class_link(...[CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 88, $this->source); })()), "parent", [], "any", false, false, false, 88)]);
        }
        // line 90
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 90, $this->source); })()), "interfaces", [], "any", false, false, false, 90)) > 0)) {
            // line 91
            yield "        ";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("implements");
            // line 92
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 92, $this->source); })()), "interfaces", [], "any", false, false, false, 92));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["interface"]) {
                // line 93
                yield $macros["_v0"]->getTemplateForMacro("macro_class_link", $context, 93, $this->getSourceContext())->macro_class_link(...[$context["interface"]]);
                // line 94
                if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 94)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield ", ";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['interface'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 97
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 97, $this->source); })()), "hasMixins", [], "any", false, false, false, 97)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 98
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 98, $this->source); })()), "getMixins", [], "method", false, false, false, 98));
            foreach ($context['_seq'] as $context["_key"] => $context["mixin"]) {
                // line 99
                yield "            <i>mixin</i> ";
                yield $macros["_v0"]->getTemplateForMacro("macro_class_link", $context, 99, $this->getSourceContext())->macro_class_link(...[CoreExtension::getAttribute($this->env, $this->source, $context["mixin"], "class", [], "any", false, false, false, 99)]);
                yield "
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['mixin'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 102
        yield $macros["_v0"]->getTemplateForMacro("macro_source_link", $context, 102, $this->getSourceContext())->macro_source_link(...[(isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 102, $this->source); })()), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 102, $this->source); })())]);
        yield "
";
        yield from [];
    }

    // line 105
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_method_signature(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 106
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 106, $this->source); })()), "final", [], "any", false, false, false, 106)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "final";
        }
        // line 107
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 107, $this->source); })()), "abstract", [], "any", false, false, false, 107)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "abstract";
        }
        // line 108
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 108, $this->source); })()), "static", [], "any", false, false, false, 108)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "static";
        }
        // line 109
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 109, $this->source); })()), "protected", [], "any", false, false, false, 109)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "protected";
        }
        // line 110
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 110, $this->source); })()), "private", [], "any", false, false, false, 110)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "private";
        }
        // line 111
        yield "    ";
        yield $macros["_v0"]->getTemplateForMacro("macro_hint_link", $context, 111, $this->getSourceContext())->macro_hint_link(...[CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 111, $this->source); })()), "hint", [], "any", false, false, false, 111), CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 111, $this->source); })()), "isIntersectionType", [], "method", false, false, false, 111)]);
        yield "
    <strong>";
        // line 112
        yield CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 112, $this->source); })()), "name", [], "any", false, false, false, 112);
        yield "</strong>";
        yield from         $this->unwrap()->yieldBlock("method_parameters_signature", $context, $blocks);
        yield from [];
    }

    // line 115
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_method_parameters_signature(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 116
        $macros["_v1"] = $this->load("macros.twig", 116)->unwrap();
        // line 117
        yield $macros["_v1"]->getTemplateForMacro("macro_method_parameters_signature", $context, 117, $this->getSourceContext())->macro_method_parameters_signature(...[(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 117, $this->source); })())]);
        yield "
    ";
        // line 118
        yield $macros["_v0"]->getTemplateForMacro("macro_deprecated", $context, 118, $this->getSourceContext())->macro_deprecated(...[(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 118, $this->source); })())]);
        yield from [];
    }

    // line 121
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_parameters(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 122
        yield "    <table class=\"table table-condensed\">
        ";
        // line 123
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 123, $this->source); })()), "parameters", [], "any", false, false, false, 123));
        foreach ($context['_seq'] as $context["_key"] => $context["parameter"]) {
            // line 124
            yield "            <tr>
                <td>";
            // line 125
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["parameter"], "hint", [], "any", false, false, false, 125)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $macros["_v0"]->getTemplateForMacro("macro_hint_link", $context, 125, $this->getSourceContext())->macro_hint_link(...[CoreExtension::getAttribute($this->env, $this->source, $context["parameter"], "hint", [], "any", false, false, false, 125), CoreExtension::getAttribute($this->env, $this->source, $context["parameter"], "isIntersectionType", [], "method", false, false, false, 125)]);
            }
            yield "</td>
                <td>";
            // line 126
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["parameter"], "variadic", [], "any", false, false, false, 126)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "...";
            }
            yield "\$";
            yield CoreExtension::getAttribute($this->env, $this->source, $context["parameter"], "name", [], "any", false, false, false, 126);
            yield "</td>
                <td>";
            // line 127
            yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, $context["parameter"], "shortdesc", [], "any", false, false, false, 127), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 127, $this->source); })())));
            yield "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['parameter'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 130
        yield "    </table>
";
        yield from [];
    }

    // line 133
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_return(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 134
        yield "    <table class=\"table table-condensed\">
        <tr>
            <td>";
        // line 136
        yield $macros["_v0"]->getTemplateForMacro("macro_hint_link", $context, 136, $this->getSourceContext())->macro_hint_link(...[CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 136, $this->source); })()), "hint", [], "any", false, false, false, 136), CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 136, $this->source); })()), "isIntersectionType", [], "method", false, false, false, 136)]);
        yield "</td>
            <td>";
        // line 137
        yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 137, $this->source); })()), "hintDesc", [], "any", false, false, false, 137), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 137, $this->source); })())));
        yield "</td>
        </tr>
    </table>
";
        yield from [];
    }

    // line 142
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_exceptions(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 143
        yield "    <table class=\"table table-condensed\">
        ";
        // line 144
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 144, $this->source); })()), "exceptions", [], "any", false, false, false, 144));
        foreach ($context['_seq'] as $context["_key"] => $context["exception"]) {
            // line 145
            yield "            <tr>
                <td>";
            // line 146
            yield $macros["_v0"]->getTemplateForMacro("macro_class_link", $context, 146, $this->getSourceContext())->macro_class_link(...[CoreExtension::getAttribute($this->env, $this->source, $context["exception"], 0, [], "array", false, false, false, 146)]);
            yield "</td>
                <td>";
            // line 147
            yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, $context["exception"], 1, [], "array", false, false, false, 147), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 147, $this->source); })())));
            yield "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['exception'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 150
        yield "    </table>
";
        yield from [];
    }

    // line 153
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_examples(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 154
        yield "    <table class=\"table table-condensed\">
        ";
        // line 155
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 155, $this->source); })()), "getExamples", [], "method", false, false, false, 155));
        foreach ($context['_seq'] as $context["_key"] => $context["example"]) {
            // line 156
            yield "            <tr>
                <td><pre class=\"examples\">";
            // line 158
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join($context["example"], " "), "html", null, true);
            // line 159
            yield "</pre></td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['example'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 162
        yield "    </table>
";
        yield from [];
    }

    // line 165
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_see(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 166
        yield "    <table class=\"table table-condensed\">
        ";
        // line 167
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 167, $this->source); })()), "getSee", [], "method", false, false, false, 167));
        foreach ($context['_seq'] as $context["_key"] => $context["see"]) {
            // line 168
            yield "            <tr>
                <td>
                    ";
            // line 170
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["see"], 4, [], "array", false, false, false, 170)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 171
                yield "                        <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["see"], 4, [], "array", false, false, false, 171), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["see"], 4, [], "array", false, false, false, 171), "html", null, true);
                yield "</a>
                    ";
            } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,             // line 172
$context["see"], 3, [], "array", false, false, false, 172)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 173
                yield "                        ";
                yield $macros["_v0"]->getTemplateForMacro("macro_method_link", $context, 173, $this->getSourceContext())->macro_method_link(...[CoreExtension::getAttribute($this->env, $this->source, $context["see"], 3, [], "array", false, false, false, 173), false, false]);
                yield "
                    ";
            } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,             // line 174
$context["see"], 2, [], "array", false, false, false, 174)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 175
                yield "                        ";
                yield $macros["_v0"]->getTemplateForMacro("macro_class_link", $context, 175, $this->getSourceContext())->macro_class_link(...[CoreExtension::getAttribute($this->env, $this->source, $context["see"], 2, [], "array", false, false, false, 175)]);
                yield "
                    ";
            } else {
                // line 177
                yield "                        ";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["see"], 0, [], "array", false, false, false, 177);
                yield "
                    ";
            }
            // line 179
            yield "                </td>
                <td>";
            // line 180
            yield CoreExtension::getAttribute($this->env, $this->source, $context["see"], 1, [], "array", false, false, false, 180);
            yield "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['see'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 183
        yield "    </table>
";
        yield from [];
    }

    // line 186
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_constants(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 187
        yield "    <table class=\"table table-condensed\">
        ";
        // line 188
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["constants"]) || array_key_exists("constants", $context) ? $context["constants"] : (function () { throw new RuntimeError('Variable "constants" does not exist.', 188, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["constant"]) {
            // line 189
            yield "            <tr>
                <td>
                    ";
            // line 192
            yield "                    ";
            // line 193
            yield "                    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["constant"], "isPrivate", [], "method", false, false, false, 193)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "private
                    ";
            } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,             // line 194
$context["constant"], "isProtected", [], "method", false, false, false, 194)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "protected";
            }
            // line 195
            yield "                    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["constant"], "isInternal", [], "method", false, false, false, 195)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"label label-warning\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("internal");
                yield "</span>";
            }
            // line 196
            yield "                    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["constant"], "isDeprecated", [], "method", false, false, false, 196)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"label label-danger\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("deprecated");
                yield "</span>";
            }
            // line 197
            yield "                    ";
            yield CoreExtension::getAttribute($this->env, $this->source, $context["constant"], "name", [], "any", false, false, false, 197);
            yield "
                    ";
            // line 198
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["constant"], "hasSince", [], "method", false, false, false, 198)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 199
                yield "                        <i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Since:"), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["constant"], "getSince", [], "method", false, false, false, 199), "html", null, true);
                yield "</i>
                        <br>
                    ";
            }
            // line 202
            yield "                </td>
                <td class=\"last\">
                    <p><em>";
            // line 204
            yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, $context["constant"], "shortdesc", [], "any", false, false, false, 204), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 204, $this->source); })())));
            yield "</em></p>
                    <p>";
            // line 205
            yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, $context["constant"], "longdesc", [], "any", false, false, false, 205), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 205, $this->source); })())));
            yield "</p>
                </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['constant'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 209
        yield "    </table>
";
        yield from [];
    }

    // line 212
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_properties(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 213
        yield "    <table class=\"table table-condensed\">
        ";
        // line 214
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 214, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["property"]) {
            // line 215
            yield "            <tr>
                <td class=\"type\" id=\"property_";
            // line 216
            yield CoreExtension::getAttribute($this->env, $this->source, $context["property"], "name", [], "any", false, false, false, 216);
            yield "\">
                    ";
            // line 217
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["property"], "isStatic", [], "method", false, false, false, 217)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "static";
            }
            // line 218
            yield "                    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["property"], "isProtected", [], "method", false, false, false, 218)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "protected";
            }
            // line 219
            yield "                    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["property"], "isPrivate", [], "method", false, false, false, 219)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "private";
            }
            // line 220
            yield "                    ";
            yield $macros["_v0"]->getTemplateForMacro("macro_hint_link", $context, 220, $this->getSourceContext())->macro_hint_link(...[CoreExtension::getAttribute($this->env, $this->source, $context["property"], "hint", [], "any", false, false, false, 220), CoreExtension::getAttribute($this->env, $this->source, $context["property"], "isIntersectionType", [], "method", false, false, false, 220)]);
            yield "
                    ";
            // line 221
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["property"], "isInternal", [], "method", false, false, false, 221)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"label label-warning\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("internal");
                yield "</span>";
            }
            // line 222
            yield "                    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["property"], "isDeprecated", [], "method", false, false, false, 222)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"label label-danger\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("deprecated");
                yield "</span>";
            }
            // line 223
            yield "                    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["property"], "isReadOnly", [], "method", false, false, false, 223)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"label label-primary\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("read-only");
                yield "</span>";
            }
            // line 224
            yield "                    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["property"], "isWriteOnly", [], "method", false, false, false, 224)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"label label-success\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("write-only");
                yield "</span>";
            }
            // line 225
            yield "
                    ";
            // line 226
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["property"], "hasSince", [], "method", false, false, false, 226)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 227
                yield "                        <i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Since:"), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["property"], "getSince", [], "method", false, false, false, 227), "html", null, true);
                yield "</i>
                        <br>
                    ";
            }
            // line 230
            yield "                </td>
                <td>\$";
            // line 231
            yield CoreExtension::getAttribute($this->env, $this->source, $context["property"], "name", [], "any", false, false, false, 231);
            yield "</td>
                <td class=\"last\">";
            // line 232
            yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, $context["property"], "shortdesc", [], "any", false, false, false, 232), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 232, $this->source); })())));
            yield "</td>
                <td>";
            // line 234
            if ((($tmp =  !(CoreExtension::getAttribute($this->env, $this->source, $context["property"], "class", [], "any", false, false, false, 234) === (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 234, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 235
                yield "<small>";
                yield Twig\Extension\CoreExtension::sprintf(\Wdes\phpI18nL10n\Launcher::gettext("from&nbsp;%s"), $macros["_v0"]->getTemplateForMacro("macro_property_link", $context, 235, $this->getSourceContext())->macro_property_link(...[$context["property"], false, true]));
                yield "</small>";
            }
            // line 237
            yield "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['property'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 240
        yield "    </table>
";
        yield from [];
    }

    // line 243
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_methods(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 244
        yield "    <div class=\"container-fluid underlined\">
        ";
        // line 245
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["methods"]) || array_key_exists("methods", $context) ? $context["methods"] : (function () { throw new RuntimeError('Variable "methods" does not exist.', 245, $this->source); })()));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 246
            yield "            <div class=\"row\">
                <div class=\"col-md-2 type\">
                    ";
            // line 248
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["method"], "static", [], "any", false, false, false, 248)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "static&nbsp;";
            }
            yield $macros["_v0"]->getTemplateForMacro("macro_hint_link", $context, 248, $this->getSourceContext())->macro_hint_link(...[CoreExtension::getAttribute($this->env, $this->source, $context["method"], "hint", [], "any", false, false, false, 248), CoreExtension::getAttribute($this->env, $this->source, $context["method"], "isIntersectionType", [], "method", false, false, false, 248)]);
            yield "
                </div>
                <div class=\"col-md-8\">
                    <a href=\"#method_";
            // line 251
            yield CoreExtension::getAttribute($this->env, $this->source, $context["method"], "name", [], "any", false, false, false, 251);
            yield "\">";
            yield CoreExtension::getAttribute($this->env, $this->source, $context["method"], "name", [], "any", false, false, false, 251);
            yield "</a>";
            yield from             $this->unwrap()->yieldBlock("method_parameters_signature", $context, $blocks);
            yield "
                    ";
            // line 252
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["method"], "shortdesc", [], "any", false, false, false, 252)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 253
                yield "                        <p class=\"no-description\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("No description");
                yield "</p>
                    ";
            } else {
                // line 255
                yield "                        <p>";
                yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, $context["method"], "shortdesc", [], "any", false, false, false, 255), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 255, $this->source); })())));
                yield "</p>";
            }
            // line 257
            yield "                </div>
                <div class=\"col-md-2\">";
            // line 259
            if ((($tmp =  !(CoreExtension::getAttribute($this->env, $this->source, $context["method"], "class", [], "any", false, false, false, 259) === (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 259, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 260
                yield "<small>";
                yield Twig\Extension\CoreExtension::sprintf(\Wdes\phpI18nL10n\Launcher::gettext("from&nbsp;%s"), $macros["_v0"]->getTemplateForMacro("macro_method_link", $context, 260, $this->getSourceContext())->macro_method_link(...[$context["method"], false, true]));
                yield "</small>";
            }
            // line 262
            yield "</div>
            </div>
        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 265
        yield "    </div>
";
        yield from [];
    }

    // line 268
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_methods_details(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 269
        yield "    <div id=\"method-details\">
        ";
        // line 270
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["methods"]) || array_key_exists("methods", $context) ? $context["methods"] : (function () { throw new RuntimeError('Variable "methods" does not exist.', 270, $this->source); })()));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 271
            yield "            <div class=\"method-item\">
                ";
            // line 272
            yield from             $this->unwrap()->yieldBlock("method", $context, $blocks);
            yield "
            </div>
        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 275
        yield "    </div>
";
        yield from [];
    }

    // line 278
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_method(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 279
        yield "    <h3 id=\"method_";
        yield CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 279, $this->source); })()), "name", [], "any", false, false, false, 279);
        yield "\">
        <div class=\"location\">";
        // line 280
        if ((($tmp =  !(CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 280, $this->source); })()), "class", [], "any", false, false, false, 280) === (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 280, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield Twig\Extension\CoreExtension::sprintf(\Wdes\phpI18nL10n\Launcher::gettext("in %s"), $macros["_v0"]->getTemplateForMacro("macro_method_link", $context, 280, $this->getSourceContext())->macro_method_link(...[(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 280, $this->source); })()), false, true]));
            yield " ";
        }
        yield $macros["_v0"]->getTemplateForMacro("macro_method_source_link", $context, 280, $this->getSourceContext())->macro_method_source_link(...[(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 280, $this->source); })())]);
        yield "</div>
        <code>";
        // line 281
        yield from         $this->unwrap()->yieldBlock("method_signature", $context, $blocks);
        yield "</code>
    </h3>
    <div class=\"details\">";
        // line 284
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 284, $this->source); })()), "hasSince", [], "method", false, false, false, 284)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 285
            yield "<i>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Since:"), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 285, $this->source); })()), "getSince", [], "method", false, false, false, 285), "html", null, true);
            yield "</i>
            <br>";
        }
        // line 288
        yield $macros["_v0"]->getTemplateForMacro("macro_categories", $context, 288, $this->getSourceContext())->macro_categories(...[(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 288, $this->source); })())]);
        yield "
        ";
        // line 289
        yield $macros["_v0"]->getTemplateForMacro("macro_deprecations", $context, 289, $this->getSourceContext())->macro_deprecations(...[(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 289, $this->source); })())]);
        yield "
        ";
        // line 290
        yield $macros["_v0"]->getTemplateForMacro("macro_internals", $context, 290, $this->getSourceContext())->macro_internals(...[(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 290, $this->source); })())]);
        yield "

        <div class=\"method-description\">
            ";
        // line 293
        if (( !CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 293, $this->source); })()), "shortdesc", [], "any", false, false, false, 293) &&  !CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 293, $this->source); })()), "longdesc", [], "any", false, false, false, 293))) {
            // line 294
            yield "                <p class=\"no-description\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("No description");
            yield "</p>
            ";
        } else {
            // line 296
            yield "                ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 296, $this->source); })()), "shortdesc", [], "any", false, false, false, 296)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 297
                yield "<p>";
                yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 297, $this->source); })()), "shortdesc", [], "any", false, false, false, 297), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 297, $this->source); })())));
                yield "</p>";
            }
            // line 299
            yield "                ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 299, $this->source); })()), "longdesc", [], "any", false, false, false, 299)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 300
                yield "<p>";
                yield $this->extensions['Doctum\Renderer\TwigExtension']->markdownToHtml($this->extensions['Doctum\Renderer\TwigExtension']->parseDesc(CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 300, $this->source); })()), "longdesc", [], "any", false, false, false, 300), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 300, $this->source); })())));
                yield "</p>";
            }
        }
        // line 303
        yield $macros["_v0"]->getTemplateForMacro("macro_todos", $context, 303, $this->getSourceContext())->macro_todos(...[(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 303, $this->source); })())]);
        // line 304
        yield "</div>
        <div class=\"tags\">
            ";
        // line 306
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 306, $this->source); })()), "parameters", [], "any", false, false, false, 306)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 307
            yield "                <h4>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Parameters");
            yield "</h4>

                ";
            // line 309
            yield from             $this->unwrap()->yieldBlock("parameters", $context, $blocks);
            yield "
            ";
        }
        // line 311
        yield "
            ";
        // line 312
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 312, $this->source); })()), "hintDesc", [], "any", false, false, false, 312) || CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 312, $this->source); })()), "hint", [], "any", false, false, false, 312))) {
            // line 313
            yield "                <h4>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Return Value");
            yield "</h4>

                ";
            // line 315
            yield from             $this->unwrap()->yieldBlock("return", $context, $blocks);
            yield "
            ";
        }
        // line 317
        yield "
            ";
        // line 318
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 318, $this->source); })()), "exceptions", [], "any", false, false, false, 318)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 319
            yield "                <h4>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Exceptions");
            yield "</h4>

                ";
            // line 321
            yield from             $this->unwrap()->yieldBlock("exceptions", $context, $blocks);
            yield "
            ";
        }
        // line 323
        yield "
            ";
        // line 324
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 324, $this->source); })()), "tags", ["see"], "method", false, false, false, 324)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 325
            yield "                <h4>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("See also");
            yield "</h4>

                ";
            // line 327
            yield from             $this->unwrap()->yieldBlock("see", $context, $blocks);
            yield "
            ";
        }
        // line 329
        yield "
            ";
        // line 330
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 330, $this->source); })()), "hasExamples", [], "method", false, false, false, 330)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 331
            yield "                <h4>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Examples");
            yield "</h4>

                ";
            // line 333
            yield from             $this->unwrap()->yieldBlock("examples", $context, $blocks);
            yield "
            ";
        }
        // line 335
        yield "        </div>
    </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "class.twig";
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
        return array (  1161 => 335,  1156 => 333,  1150 => 331,  1148 => 330,  1145 => 329,  1140 => 327,  1134 => 325,  1132 => 324,  1129 => 323,  1124 => 321,  1118 => 319,  1116 => 318,  1113 => 317,  1108 => 315,  1102 => 313,  1100 => 312,  1097 => 311,  1092 => 309,  1086 => 307,  1084 => 306,  1080 => 304,  1078 => 303,  1072 => 300,  1069 => 299,  1064 => 297,  1061 => 296,  1055 => 294,  1053 => 293,  1047 => 290,  1043 => 289,  1039 => 288,  1031 => 285,  1029 => 284,  1024 => 281,  1016 => 280,  1011 => 279,  1004 => 278,  998 => 275,  981 => 272,  978 => 271,  961 => 270,  958 => 269,  951 => 268,  945 => 265,  929 => 262,  924 => 260,  922 => 259,  919 => 257,  914 => 255,  908 => 253,  906 => 252,  898 => 251,  889 => 248,  885 => 246,  868 => 245,  865 => 244,  858 => 243,  852 => 240,  844 => 237,  839 => 235,  837 => 234,  833 => 232,  829 => 231,  826 => 230,  817 => 227,  815 => 226,  812 => 225,  805 => 224,  798 => 223,  791 => 222,  785 => 221,  780 => 220,  775 => 219,  770 => 218,  766 => 217,  762 => 216,  759 => 215,  755 => 214,  752 => 213,  745 => 212,  739 => 209,  729 => 205,  725 => 204,  721 => 202,  712 => 199,  710 => 198,  705 => 197,  698 => 196,  691 => 195,  687 => 194,  682 => 193,  680 => 192,  676 => 189,  672 => 188,  669 => 187,  662 => 186,  656 => 183,  647 => 180,  644 => 179,  638 => 177,  632 => 175,  630 => 174,  625 => 173,  623 => 172,  616 => 171,  614 => 170,  610 => 168,  606 => 167,  603 => 166,  596 => 165,  590 => 162,  582 => 159,  580 => 158,  577 => 156,  573 => 155,  570 => 154,  563 => 153,  557 => 150,  548 => 147,  544 => 146,  541 => 145,  537 => 144,  534 => 143,  527 => 142,  518 => 137,  514 => 136,  510 => 134,  503 => 133,  497 => 130,  488 => 127,  480 => 126,  474 => 125,  471 => 124,  467 => 123,  464 => 122,  457 => 121,  452 => 118,  448 => 117,  446 => 116,  439 => 115,  432 => 112,  427 => 111,  422 => 110,  417 => 109,  412 => 108,  407 => 107,  403 => 106,  396 => 105,  389 => 102,  379 => 99,  374 => 98,  372 => 97,  355 => 94,  353 => 93,  335 => 92,  332 => 91,  330 => 90,  324 => 88,  322 => 87,  319 => 86,  314 => 85,  309 => 84,  305 => 83,  298 => 82,  292 => 79,  287 => 77,  283 => 75,  277 => 73,  271 => 71,  269 => 70,  266 => 69,  261 => 67,  255 => 65,  253 => 64,  250 => 63,  245 => 61,  241 => 59,  239 => 58,  236 => 57,  231 => 55,  225 => 53,  223 => 52,  221 => 50,  217 => 48,  212 => 46,  209 => 45,  204 => 43,  202 => 42,  199 => 41,  197 => 40,  192 => 38,  188 => 37,  184 => 36,  179 => 34,  176 => 33,  167 => 30,  165 => 29,  160 => 26,  154 => 25,  150 => 24,  148 => 23,  144 => 20,  137 => 19,  126 => 13,  124 => 12,  120 => 11,  116 => 9,  113 => 8,  106 => 7,  95 => 5,  84 => 4,  71 => 3,  66 => 1,  64 => 2,  57 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layout/layout.twig\" %}
{% from \"macros.twig\" import render_classes, breadcrumbs, namespace_link, class_link, property_link, method_link, hint_link, source_link, method_source_link, deprecated, deprecations, internals, categories, todo, todos, class_category_name %}
{% block title %}{{ class|raw }} | {{ parent() }}{% endblock %}
{% block body_class 'class' %}
{% block page_id 'class:' ~ (class.name|replace({'\\\\': '_'})) %}

{% block below_menu %}
    {% if class.namespace %}
        <div class=\"namespace-breadcrumbs\">
            <ol class=\"breadcrumb\">
                <li><span class=\"label label-default\">{{ class_category_name(class.getCategoryId()) }}</span></li>
                {{ breadcrumbs(class.namespace) -}}
                <li>{{ class.shortname|raw }}</li>
            </ol>
        </div>
    {% endif %}
{% endblock %}

{% block page_content %}

    <div class=\"page-header\">
        <h1>
            {{- class.name|split('\\\\')|last|raw -}}
            {{- deprecated(class) }}
            {% if class.isReadOnly() %}<small><span class=\"label label-primary\">{% trans 'read-only' %}</span></small>{% endif -%}
        </h1>
    </div>

    {% if class.hasSince() %}
        <i>{{ 'Since:'|trans }} {{ class.getSince() }}</i>
        <br>
    {% endif %}

    <p>{{ block('class_signature') }}</p>

    {{ categories(class) }}
    {{ deprecations(class) }}
    {{ internals(class) }}

    {% if class.shortdesc or class.longdesc %}
        <div class=\"description\">
            {% if class.shortdesc -%}
                <p>{{ class.shortdesc|desc(class)|md_to_html }}</p>
            {%- endif %}
            {% if class.longdesc -%}
                <p>{{ class.longdesc|desc(class)|md_to_html }}</p>
            {%- endif %}
        </div>
    {% endif %}
    {{- todos(class) -}}

    {% if traits %}
        <h2>{% trans 'Traits' %}</h2>

        {{ render_classes(traits) }}
    {% endif %}

    {% if constants %}
        <h2>{% trans 'Constants' %}</h2>

        {{- block('constants') }}
    {% endif %}

    {% if properties %}
        <h2>{% trans 'Properties' %}</h2>

        {{ block('properties') }}
    {% endif %}

    {% if methods %}
        <h2>{% trans 'Methods' %}</h2>

        {{ block('methods') }}

        <h2>{% trans 'Details' %}</h2>

        {{ block('methods_details') }}
    {% endif %}

{% endblock %}

{% block class_signature -%}
    {% if class.final %}final {% endif %}
    {% if not class.interface and class.abstract %}abstract {% endif %}
    {{ class_category_name(class.getCategoryId()) }}
    <strong>{{ class.shortname|raw }}</strong>
    {%- if class.parent %}
        {% trans 'extends' %} {{ class_link(class.parent) }}
    {%- endif %}
    {%- if class.interfaces|length > 0 %}
        {% trans 'implements' %}
        {% for interface in class.interfaces %}
            {{- class_link(interface) }}
            {%- if not loop.last %}, {% endif %}
        {%- endfor %}
    {%- endif %}
    {%- if class.hasMixins %}
        {% for mixin in class.getMixins() %}
            <i>mixin</i> {{ class_link(mixin.class) }}
        {% endfor %}
    {%- endif %}
    {{- source_link(project, class) }}
{% endblock %}

{% block method_signature -%}
    {% if method.final %}final{% endif %}
    {% if method.abstract %}abstract{% endif %}
    {% if method.static %}static{% endif %}
    {% if method.protected %}protected{% endif %}
    {% if method.private %}private{% endif %}
    {{ hint_link(method.hint, method.isIntersectionType()) }}
    <strong>{{ method.name|raw }}</strong>{{ block('method_parameters_signature') }}
{%- endblock %}

{% block method_parameters_signature -%}
    {%- from \"macros.twig\" import method_parameters_signature -%}
    {{ method_parameters_signature(method) }}
    {{ deprecated(method) }}
{%- endblock %}

{% block parameters %}
    <table class=\"table table-condensed\">
        {% for parameter in method.parameters %}
            <tr>
                <td>{% if parameter.hint %}{{ hint_link(parameter.hint, parameter.isIntersectionType()) }}{% endif %}</td>
                <td>{%- if parameter.variadic %}...{% endif %}\${{ parameter.name|raw }}</td>
                <td>{{ parameter.shortdesc|desc(class)|md_to_html }}</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}

{% block return %}
    <table class=\"table table-condensed\">
        <tr>
            <td>{{ hint_link(method.hint, method.isIntersectionType()) }}</td>
            <td>{{ method.hintDesc|desc(class)|md_to_html }}</td>
        </tr>
    </table>
{% endblock %}

{% block exceptions %}
    <table class=\"table table-condensed\">
        {% for exception in method.exceptions %}
            <tr>
                <td>{{ class_link(exception[0]) }}</td>
                <td>{{ exception[1]|desc(class)|md_to_html }}</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}

{% block examples %}
    <table class=\"table table-condensed\">
        {% for example in method.getExamples() %}
            <tr>
                <td><pre class=\"examples\">
                    {{- example|join(' ') -}}
                </pre></td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}

{% block see %}
    <table class=\"table table-condensed\">
        {% for see in method.getSee() %}
            <tr>
                <td>
                    {% if see[4] %}
                        <a href=\"{{see[4]}}\">{{see[4]}}</a>
                    {% elseif see[3] %}
                        {{ method_link(see[3], false, false) }}
                    {% elseif see[2] %}
                        {{ class_link(see[2]) }}
                    {% else %}
                        {{ see[0]|raw }}
                    {% endif %}
                </td>
                <td>{{ see[1]|raw }}</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}

{% block constants %}
    <table class=\"table table-condensed\">
        {% for constant in constants %}
            <tr>
                <td>
                    {# Keep in order with an else if, it can be set by typehints and by annotations #}
                    {# More restricted wins #}
                    {% if constant.isPrivate() %}private
                    {% elseif constant.isProtected() %}protected{% endif %}
                    {% if constant.isInternal() %}<span class=\"label label-warning\">{% trans 'internal' %}</span>{% endif %}
                    {% if constant.isDeprecated() %}<span class=\"label label-danger\">{% trans 'deprecated' %}</span>{% endif %}
                    {{ constant.name|raw }}
                    {% if constant.hasSince() %}
                        <i>{{ 'Since:'|trans }} {{ constant.getSince() }}</i>
                        <br>
                    {% endif %}
                </td>
                <td class=\"last\">
                    <p><em>{{ constant.shortdesc|desc(class)|md_to_html }}</em></p>
                    <p>{{ constant.longdesc|desc(class)|md_to_html }}</p>
                </td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}

{% block properties %}
    <table class=\"table table-condensed\">
        {% for property in properties %}
            <tr>
                <td class=\"type\" id=\"property_{{ property.name|raw }}\">
                    {% if property.isStatic() %}static{% endif %}
                    {% if property.isProtected() %}protected{% endif %}
                    {% if property.isPrivate() %}private{% endif %}
                    {{ hint_link(property.hint, property.isIntersectionType()) }}
                    {% if property.isInternal() %}<span class=\"label label-warning\">{% trans 'internal' %}</span>{% endif %}
                    {% if property.isDeprecated() %}<span class=\"label label-danger\">{% trans 'deprecated' %}</span>{% endif %}
                    {% if property.isReadOnly() %}<span class=\"label label-primary\">{% trans 'read-only' %}</span>{% endif %}
                    {% if property.isWriteOnly() %}<span class=\"label label-success\">{% trans 'write-only' %}</span>{% endif %}

                    {% if property.hasSince() %}
                        <i>{{ 'Since:'|trans }} {{ property.getSince() }}</i>
                        <br>
                    {% endif %}
                </td>
                <td>\${{ property.name|raw }}</td>
                <td class=\"last\">{{ property.shortdesc|desc(class)|md_to_html }}</td>
                <td>
                    {%- if property.class is not same as(class) -%}
                        <small>{{ 'from&nbsp;%s'|trans|format(property_link(property, false, true))|raw }}</small>
                    {%- endif -%}
                </td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}

{% block methods %}
    <div class=\"container-fluid underlined\">
        {% for method in methods %}
            <div class=\"row\">
                <div class=\"col-md-2 type\">
                    {% if method.static %}static&nbsp;{% endif %}{{ hint_link(method.hint, method.isIntersectionType()) }}
                </div>
                <div class=\"col-md-8\">
                    <a href=\"#method_{{ method.name|raw }}\">{{ method.name|raw }}</a>{{ block('method_parameters_signature') }}
                    {% if not method.shortdesc %}
                        <p class=\"no-description\">{% trans 'No description' %}</p>
                    {% else %}
                        <p>{{ method.shortdesc|desc(class)|md_to_html }}</p>
                    {%- endif %}
                </div>
                <div class=\"col-md-2\">
                    {%- if method.class is not same as(class) -%}
                        <small>{{ 'from&nbsp;%s'|trans|format(method_link(method, false, true))|raw }}</small>
                    {%- endif -%}
                </div>
            </div>
        {% endfor %}
    </div>
{% endblock %}

{% block methods_details %}
    <div id=\"method-details\">
        {% for method in methods %}
            <div class=\"method-item\">
                {{ block('method') }}
            </div>
        {% endfor %}
    </div>
{% endblock %}

{% block method %}
    <h3 id=\"method_{{ method.name|raw }}\">
        <div class=\"location\">{% if method.class is not same as(class) %}{{ 'in %s'|trans|format(method_link(method, false, true))|raw }} {% endif %}{{ method_source_link(method) }}</div>
        <code>{{ block('method_signature') }}</code>
    </h3>
    <div class=\"details\">
        {%- if method.hasSince() -%}
            <i>{{ 'Since:'|trans }} {{ method.getSince() }}</i>
            <br>
        {%- endif -%}
        {{ categories(method) }}
        {{ deprecations(method) }}
        {{ internals(method) }}

        <div class=\"method-description\">
            {% if not method.shortdesc and not method.longdesc %}
                <p class=\"no-description\">{% trans 'No description' %}</p>
            {% else %}
                {% if method.shortdesc -%}
                <p>{{ method.shortdesc|desc(class)|md_to_html }}</p>
                {%- endif %}
                {% if method.longdesc -%}
                <p>{{ method.longdesc|desc(class)|md_to_html }}</p>
                {%- endif %}
            {%- endif %}
            {{- todos(method) -}}
        </div>
        <div class=\"tags\">
            {% if method.parameters %}
                <h4>{% trans 'Parameters' %}</h4>

                {{ block('parameters') }}
            {% endif %}

            {% if method.hintDesc or method.hint %}
                <h4>{% trans 'Return Value' %}</h4>

                {{ block('return') }}
            {% endif %}

            {% if method.exceptions %}
                <h4>{% trans 'Exceptions' %}</h4>

                {{ block('exceptions') }}
            {% endif %}

            {% if method.tags('see') %}
                <h4>{% trans 'See also' %}</h4>

                {{ block('see') }}
            {% endif %}

            {% if method.hasExamples() %}
                <h4>{% trans 'Examples' %}</h4>

                {{ block('examples') }}
            {% endif %}
        </div>
    </div>
{% endblock %}
", "class.twig", "/Users/yuvisingh1265/Documents/GitHub/Studyroom-platform/vendor/code-lts/doctum/src/Resources/themes/default/class.twig");
    }
}
