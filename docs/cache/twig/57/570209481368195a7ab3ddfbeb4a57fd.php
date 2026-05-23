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

/* search.twig */
class __TwigTemplate_3e0fc55bc4c8f527fc3a98c68982b202 extends Template
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
            'js_search' => [$this, 'block_js_search'],
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
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search");
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
        yield "search-page";
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
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search");
        // line 9
        yield "</h1>
    </div>

    <p>";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("This page allows you to search through the API documentation for
    specific terms. Enter your search words into the box below and click
    \"submit\". The search will be performed on namespaces, classes, interfaces,
    traits, functions, and methods.");
        // line 15
        yield "</p>

    <form class=\"form-inline\" role=\"form\" action=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "search.html"), "html", null, true);
        yield "\">
        <div class=\"form-group\">
            <label class=\"sr-only\" for=\"search\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search");
        // line 19
        yield "</label>
            <input type=\"search\" class=\"form-control\" name=\"search\" id=\"search\" placeholder=\"";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search");
        // line 20
        yield "\" spellcheck=\"false\" autocorrect=\"off\" autocomplete=\"off\" autocapitalize=\"off\">
        </div>
        <button type=\"submit\" class=\"btn btn-default\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("submit");
        // line 22
        yield "</button>
    </form>

    <h2 id=\"search-results-header\">";
yield \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search Results");
        // line 25
        yield "</h2>
    <div class=\"search-bar hidden\" id=\"search-page-progress-bar-container\">
        <div class=\"progress\">
            <div class=\"progress-bar\" role=\"progressbar\" id=\"search-page-progress-bar\"
                aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 0%\"></div>
        </div>
    </div>
    <div class=\"container-fluid\" id=\"search-results-container\">
    </div>

    ";
        // line 35
        yield from         $this->unwrap()->yieldBlock("js_search", $context, $blocks);
        yield "

";
        yield from [];
    }

    // line 39
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js_search(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 40
        yield "    <script type=\"text/javascript\">
        var DoctumSearch = {
            /** @var boolean */
            pageFullyLoaded: false,
            /** @var string|null */
            searchTerm: null,
            /** @var autoComplete|null */
            autoCompleteJS: null,
            /** @var HTMLElement|null */
            doctumSearchPageAutoCompleteProgressBarContainer: null,
            /** @var HTMLElement|null */
            doctumSearchPageAutoCompleteProgressBar: null,
            searchTypeClasses: {
                '";
        // line 53
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Namespace"), "js"), "html", null, true);
        yield "': 'label-default',
                '";
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Class"), "js"), "html", null, true);
        yield "': 'label-info',
                '";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Trait"), "js"), "html", null, true);
        yield "': 'label-success',
                '";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Interface"), "js"), "html", null, true);
        yield "': 'label-primary',
                '";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Method"), "js"), "html", null, true);
        yield "': 'label-danger',
                '";
        // line 58
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Function"), "js"), "html", null, true);
        yield "': 'label-danger',
                '_': 'label-warning'
            },
            longTypes: {
                'N': '";
        // line 62
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Namespace"), "js"), "html", null, true);
        yield "',
                'C': '";
        // line 63
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Class"), "js"), "html", null, true);
        yield "',
                'T': '";
        // line 64
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Trait"), "js"), "html", null, true);
        yield "',
                'I': '";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Interface"), "js"), "html", null, true);
        yield "',
                'M': '";
        // line 66
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Method"), "js"), "html", null, true);
        yield "',
                'F': '";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Function"), "js"), "html", null, true);
        yield "',
                '_': 'label-warning'
            },
            /**
             * Cleans the provided term. If no term is provided, then one is
             * grabbed from the query string \"search\" parameter.
             */
            cleanSearchTerm: function(term) {
                // Grab from the query string
                if (typeof term === 'undefined') {
                    var name = 'search';
                    var regex = new RegExp(\"[\\\\?&]\" + name + \"=([^&#]*)\");
                    var results = regex.exec(location.search);
                    if (results === null) {
                        return null;
                    }
                    term = decodeURIComponent(results[1].replace(/\\+/g, \" \"));
                }

                return term.replace(/<(?:.|\\n)*?>/gm, '');
            },
            /**
             * Get a search class for a specific type
             */
            getSearchClass: function(type) {
                return DoctumSearch.searchTypeClasses[type] || DoctumSearch.searchTypeClasses['_'];
            },
            /**
             * Get the long type name
             */
            getLongType: function(type) {
                return DoctumSearch.longTypes[type] || DoctumSearch.longTypes['_'];
            },
            pageFullyLoaded: function (event) {// Will get fired by the main doctum.js script
                DoctumSearch.searchTerm = DoctumSearch.cleanSearchTerm();
                DoctumSearch.searchTermForEngine = Doctum.cleanSearchQuery(DoctumSearch.searchTerm);
                DoctumSearch.doctumSearchPageAutoCompleteProgressBarContainer = document.getElementById('search-page-progress-bar-container');
                DoctumSearch.doctumSearchPageAutoCompleteProgressBar = document.getElementById('search-page-progress-bar');
                DoctumSearch.pageFullyLoaded = true;
                DoctumSearch.launchSearch();
            },
            showNoResults: function() {
                document.getElementById('search-results-container').innerText = '";
        // line 109
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("No results were found"), "js"), "html", null, true);
        yield "';
            },
            launchSearch: function (event) {
                if (
                    DoctumSearch.searchTermForEngine === null
                    || (typeof DoctumSearch.searchTermForEngine === 'string' && DoctumSearch.searchTermForEngine.length === 0)
                    || typeof DoctumSearch.searchTermForEngine !== 'string'
                ) {
                    document.getElementById('search-results-header').className = 'hidden';
                    // Stop the process here
                    return;
                }
                // Set back backslashes to non escaped backslashes
                document.getElementById('search').value = DoctumSearch.searchTermForEngine.replace(/\\\\\\\\/g, '\\\\');

                // Check if the lib is loaded
                if (typeof autoComplete === 'function') {
                    DoctumSearch.bootAutoComplete();
                }
            },
            bootAutoComplete: function () {
                DoctumSearch.autoCompleteJS = new autoComplete(
                    {
                        selector: '#search',
                        searchEngine: function (query, record) {
                            return Doctum.searchEngine(query, record);
                        },
                        submit: true,
                        data: {
                            src: function (q) {
                                return Doctum.loadAutoCompleteData(q);
                            },
                            keys: ['n'],// Data 'Object' key to be searched
                            cache: false, // Is not compatible with async fetch of data
                        },
                        query: (input) => {
                            return Doctum.cleanSearchQuery(input);
                        },
                        trigger: (query) => {
                            return Doctum.cleanSearchQuery(query).length > 0;
                        },
                        resultsList: {
                            tag: 'ul',
                            class: 'search-results',
                            destination: '#search-results-container',
                            position: 'afterbegin',
                            maxResults: 500,
                            noResults: false,
                        },
                        resultItem: {
                            tag: 'li',
                            class: 'search-results-result',
                            highlight: 'search-results-highlight',
                            selected: 'search-results-selected',
                            element: function (item, data) {
                                item.innerHTML = '';// Clean up the content
                                var elementH2 = document.createElement('h2');
                                elementH2.className = 'clearfix';

                                var elementLink = document.createElement('a');
                                elementLink.innerText = data.value.n;
                                elementLink.href = data.value.p;
                                elementH2.appendChild(elementLink);

                                var longType = DoctumSearch.getLongType(data.value.t);
                                var className = DoctumSearch.getSearchClass(longType);

                                var divElement = document.createElement('div');
                                divElement.className = 'search-type type-' + longType;
                                var divSpanElement = document.createElement('span');
                                divSpanElement.className = 'pull-right label ' + className;
                                divSpanElement.innerText = longType;
                                divElement.appendChild(divSpanElement);
                                elementH2.appendChild(divElement);

                                item.appendChild(elementH2);

                                if (typeof data.value.f === 'object') {
                                    var fromElement = document.createElement('div');
                                    fromElement.className = 'search-from';
                                    fromElement.innerText = '";
        // line 189
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("from "), "js"), "html", null, true);
        yield "';
                                    var fromElementLink = document.createElement('a');
                                    fromElementLink.href = data.value.f.p;
                                    fromElementLink.innerText = data.value.f.n;
                                    fromElement.appendChild(fromElementLink);
                                    item.appendChild(fromElement);
                                }

                                var divSearchDescription = document.createElement('div');
                                divSearchDescription.className = 'search-description';
                                if (data.value.t === 'N') {// Is a namespace
                                    data.value.d = '";
        // line 200
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(\Wdes\phpI18nL10n\Launcher::gettext("Namespace %s"), "js"), "html", null, true);
        yield "'.replace('%s', data.value.n);
                                }
                                if (typeof data.value.d === 'string') {
                                    var paragraphElement = document.createElement('p');
                                    paragraphElement.innerHTML = data.value.d;
                                    divSearchDescription.appendChild(paragraphElement);
                                }
                                item.appendChild(divSearchDescription);
                            },
                        },
                    }
                );
                Doctum.markInProgress();
                DoctumSearch.autoCompleteJS.start(DoctumSearch.searchTerm);
                DoctumSearch.autoCompleteJS.unInit();// Stop the work, wait for the user to hit submit
                document.getElementById('search').addEventListener('results', function (event) {
                    Doctum.markProgressFinished();
                    if (event.detail.results.length === 0) {
                        DoctumSearch.showNoResults();
                    }
                });
            }
        };
    </script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "search.twig";
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
        return array (  358 => 200,  344 => 189,  261 => 109,  216 => 67,  212 => 66,  208 => 65,  204 => 64,  200 => 63,  196 => 62,  189 => 58,  185 => 57,  181 => 56,  177 => 55,  173 => 54,  169 => 53,  154 => 40,  147 => 39,  139 => 35,  127 => 25,  121 => 22,  116 => 20,  112 => 19,  106 => 17,  102 => 15,  93 => 9,  88 => 7,  81 => 6,  70 => 4,  57 => 3,  52 => 1,  50 => 2,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layout/layout.twig\" %}
{% from \"macros.twig\" import class_link, namespace_link, method_link, property_link %}
{% block title %}{% trans 'Search' %} | {{ parent() }}{% endblock %}
{% block body_class 'search-page' %}

{% block page_content %}

    <div class=\"page-header\">
        <h1>{% trans 'Search' %}</h1>
    </div>

    <p>{% trans 'This page allows you to search through the API documentation for
    specific terms. Enter your search words into the box below and click
    \"submit\". The search will be performed on namespaces, classes, interfaces,
    traits, functions, and methods.' %}</p>

    <form class=\"form-inline\" role=\"form\" action=\"{{ path('search.html') }}\">
        <div class=\"form-group\">
            <label class=\"sr-only\" for=\"search\">{% trans 'Search' %}</label>
            <input type=\"search\" class=\"form-control\" name=\"search\" id=\"search\" placeholder=\"{% trans 'Search' %}\" spellcheck=\"false\" autocorrect=\"off\" autocomplete=\"off\" autocapitalize=\"off\">
        </div>
        <button type=\"submit\" class=\"btn btn-default\">{% trans 'submit' %}</button>
    </form>

    <h2 id=\"search-results-header\">{% trans 'Search Results' %}</h2>
    <div class=\"search-bar hidden\" id=\"search-page-progress-bar-container\">
        <div class=\"progress\">
            <div class=\"progress-bar\" role=\"progressbar\" id=\"search-page-progress-bar\"
                aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 0%\"></div>
        </div>
    </div>
    <div class=\"container-fluid\" id=\"search-results-container\">
    </div>

    {{ block('js_search') }}

{% endblock %}

{% block js_search %}
    <script type=\"text/javascript\">
        var DoctumSearch = {
            /** @var boolean */
            pageFullyLoaded: false,
            /** @var string|null */
            searchTerm: null,
            /** @var autoComplete|null */
            autoCompleteJS: null,
            /** @var HTMLElement|null */
            doctumSearchPageAutoCompleteProgressBarContainer: null,
            /** @var HTMLElement|null */
            doctumSearchPageAutoCompleteProgressBar: null,
            searchTypeClasses: {
                '{{ 'Namespace'|trans|escape('js') }}': 'label-default',
                '{{ 'Class'|trans|escape('js') }}': 'label-info',
                '{{ 'Trait'|trans|escape('js') }}': 'label-success',
                '{{ 'Interface'|trans|escape('js') }}': 'label-primary',
                '{{ 'Method'|trans|escape('js') }}': 'label-danger',
                '{{ 'Function'|trans|escape('js') }}': 'label-danger',
                '_': 'label-warning'
            },
            longTypes: {
                'N': '{{ 'Namespace'|trans|escape('js') }}',
                'C': '{{ 'Class'|trans|escape('js') }}',
                'T': '{{ 'Trait'|trans|escape('js') }}',
                'I': '{{ 'Interface'|trans|escape('js') }}',
                'M': '{{ 'Method'|trans|escape('js') }}',
                'F': '{{ 'Function'|trans|escape('js') }}',
                '_': 'label-warning'
            },
            /**
             * Cleans the provided term. If no term is provided, then one is
             * grabbed from the query string \"search\" parameter.
             */
            cleanSearchTerm: function(term) {
                // Grab from the query string
                if (typeof term === 'undefined') {
                    var name = 'search';
                    var regex = new RegExp(\"[\\\\?&]\" + name + \"=([^&#]*)\");
                    var results = regex.exec(location.search);
                    if (results === null) {
                        return null;
                    }
                    term = decodeURIComponent(results[1].replace(/\\+/g, \" \"));
                }

                return term.replace(/<(?:.|\\n)*?>/gm, '');
            },
            /**
             * Get a search class for a specific type
             */
            getSearchClass: function(type) {
                return DoctumSearch.searchTypeClasses[type] || DoctumSearch.searchTypeClasses['_'];
            },
            /**
             * Get the long type name
             */
            getLongType: function(type) {
                return DoctumSearch.longTypes[type] || DoctumSearch.longTypes['_'];
            },
            pageFullyLoaded: function (event) {// Will get fired by the main doctum.js script
                DoctumSearch.searchTerm = DoctumSearch.cleanSearchTerm();
                DoctumSearch.searchTermForEngine = Doctum.cleanSearchQuery(DoctumSearch.searchTerm);
                DoctumSearch.doctumSearchPageAutoCompleteProgressBarContainer = document.getElementById('search-page-progress-bar-container');
                DoctumSearch.doctumSearchPageAutoCompleteProgressBar = document.getElementById('search-page-progress-bar');
                DoctumSearch.pageFullyLoaded = true;
                DoctumSearch.launchSearch();
            },
            showNoResults: function() {
                document.getElementById('search-results-container').innerText = '{{ 'No results were found'|trans|escape('js') }}';
            },
            launchSearch: function (event) {
                if (
                    DoctumSearch.searchTermForEngine === null
                    || (typeof DoctumSearch.searchTermForEngine === 'string' && DoctumSearch.searchTermForEngine.length === 0)
                    || typeof DoctumSearch.searchTermForEngine !== 'string'
                ) {
                    document.getElementById('search-results-header').className = 'hidden';
                    // Stop the process here
                    return;
                }
                // Set back backslashes to non escaped backslashes
                document.getElementById('search').value = DoctumSearch.searchTermForEngine.replace(/\\\\\\\\/g, '\\\\');

                // Check if the lib is loaded
                if (typeof autoComplete === 'function') {
                    DoctumSearch.bootAutoComplete();
                }
            },
            bootAutoComplete: function () {
                DoctumSearch.autoCompleteJS = new autoComplete(
                    {
                        selector: '#search',
                        searchEngine: function (query, record) {
                            return Doctum.searchEngine(query, record);
                        },
                        submit: true,
                        data: {
                            src: function (q) {
                                return Doctum.loadAutoCompleteData(q);
                            },
                            keys: ['n'],// Data 'Object' key to be searched
                            cache: false, // Is not compatible with async fetch of data
                        },
                        query: (input) => {
                            return Doctum.cleanSearchQuery(input);
                        },
                        trigger: (query) => {
                            return Doctum.cleanSearchQuery(query).length > 0;
                        },
                        resultsList: {
                            tag: 'ul',
                            class: 'search-results',
                            destination: '#search-results-container',
                            position: 'afterbegin',
                            maxResults: 500,
                            noResults: false,
                        },
                        resultItem: {
                            tag: 'li',
                            class: 'search-results-result',
                            highlight: 'search-results-highlight',
                            selected: 'search-results-selected',
                            element: function (item, data) {
                                item.innerHTML = '';// Clean up the content
                                var elementH2 = document.createElement('h2');
                                elementH2.className = 'clearfix';

                                var elementLink = document.createElement('a');
                                elementLink.innerText = data.value.n;
                                elementLink.href = data.value.p;
                                elementH2.appendChild(elementLink);

                                var longType = DoctumSearch.getLongType(data.value.t);
                                var className = DoctumSearch.getSearchClass(longType);

                                var divElement = document.createElement('div');
                                divElement.className = 'search-type type-' + longType;
                                var divSpanElement = document.createElement('span');
                                divSpanElement.className = 'pull-right label ' + className;
                                divSpanElement.innerText = longType;
                                divElement.appendChild(divSpanElement);
                                elementH2.appendChild(divElement);

                                item.appendChild(elementH2);

                                if (typeof data.value.f === 'object') {
                                    var fromElement = document.createElement('div');
                                    fromElement.className = 'search-from';
                                    fromElement.innerText = '{{ 'from '|trans|escape('js') }}';
                                    var fromElementLink = document.createElement('a');
                                    fromElementLink.href = data.value.f.p;
                                    fromElementLink.innerText = data.value.f.n;
                                    fromElement.appendChild(fromElementLink);
                                    item.appendChild(fromElement);
                                }

                                var divSearchDescription = document.createElement('div');
                                divSearchDescription.className = 'search-description';
                                if (data.value.t === 'N') {// Is a namespace
                                    data.value.d = '{{ 'Namespace %s'|trans|escape('js') }}'.replace('%s', data.value.n);
                                }
                                if (typeof data.value.d === 'string') {
                                    var paragraphElement = document.createElement('p');
                                    paragraphElement.innerHTML = data.value.d;
                                    divSearchDescription.appendChild(paragraphElement);
                                }
                                item.appendChild(divSearchDescription);
                            },
                        },
                    }
                );
                Doctum.markInProgress();
                DoctumSearch.autoCompleteJS.start(DoctumSearch.searchTerm);
                DoctumSearch.autoCompleteJS.unInit();// Stop the work, wait for the user to hit submit
                document.getElementById('search').addEventListener('results', function (event) {
                    Doctum.markProgressFinished();
                    if (event.detail.results.length === 0) {
                        DoctumSearch.showNoResults();
                    }
                });
            }
        };
    </script>
{% endblock %}
", "search.twig", "/Users/yuvisingh1265/Documents/GitHub/Studyroom-platform/vendor/code-lts/doctum/src/Resources/themes/default/search.twig");
    }
}
