<?php
/* Smarty version 5.8.0, created on 2026-06-06 16:39:47
  from 'file:cercaMateriali.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a243133688787_90621796',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13fac2455c39ec6f2a56cdcb6784fa14b5703015' => 
    array (
      0 => 'cercaMateriali.tpl',
      1 => 1780652316,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a243133688787_90621796 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_9246952656a243133664459_09947211', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2288545816a243133665d85_96978350', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12314459426a2431336663c4_26014793', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_9246952656a243133664459_09947211 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>
Risultati ricerca — StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_2288545816a243133665d85_96978350 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>

    <link rel="stylesheet" href="/../CSS/styleCercaMateriale.css">
<?php
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_12314459426a2431336663c4_26014793 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>


<!-- ===================== HERO SEARCH ===================== -->
<section class="hero-search">
    <form class="hero-search__form" action="/RicercaMateriale/cerca" method="GET">
        <input
            type="text"
            name="titolo"
            class="hero-search__input"
            placeholder="materiale cercato"
            value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('queryCorrente'), ENT_QUOTES, 'UTF-8', true);?>
"
        >
        <button type="submit" class="hero-search__btn" aria-label="Avvia ricerca">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
        </button>
    </form>
</section>
<!-- ===================== /HERO SEARCH ===================== -->


<!-- ===================== FILTRI ===================== -->
<section class="filters-bar">
    <div class="filters-bar__inner">

        <form id="filter-form" action="/RicercaMateriale/filtra" method="GET">

            <!-- Mantieni la query corrente -->
            <input type="hidden" name="q" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('queryCorrente'), ENT_QUOTES, 'UTF-8', true);?>
">
            <input type="hidden" name="page" value="1">

            <div class="filters-bar__pills">

                <!-- Corso di Laurea -->
                <div class="filter-pill <?php if ($_smarty_tpl->getValue('filtri')['corsoDiLaurea']) {?>filter-pill--active<?php }?>">
                    <select name="corsoDiLaurea" id="select-corso" class="filter-pill__select">
                        <option value="">Corso di Laurea</option>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('corsiDiLaurea'), 'corso');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('corso')->value) {
$foreach0DoElse = false;
?>
                            <option value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('corso')['id'], ENT_QUOTES, 'UTF-8', true);?>
"
                                <?php if ($_smarty_tpl->getValue('filtri')['corsoDiLaurea'] == $_smarty_tpl->getValue('corso')['id']) {?>selected<?php }?>>
                                <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('corso')['nome'], ENT_QUOTES, 'UTF-8', true);?>

                            </option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>
                </div>

                <!-- Insegnamento -->
                <div class="filter-pill 
                    <?php if ($_smarty_tpl->getValue('filtri')['insegnamento']) {?>filter-pill--active<?php }?>
                    <?php if (!$_smarty_tpl->getValue('filtri')['corsoDiLaurea']) {?>filter-pill--disabled<?php }?>">
                    
                    <select id="select-insegnamento"
                            name="insegnamento"
                            class="filter-pill__select"
                            <?php if (!$_smarty_tpl->getValue('filtri')['corsoDiLaurea']) {?>disabled<?php }?>>
                        <option value="">Insegnamento</option>

                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('insegnamenti'), 'ins');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('ins')->value) {
$foreach1DoElse = false;
?>
                            <option value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('ins')['id'], ENT_QUOTES, 'UTF-8', true);?>
"
                                    data-corso-id="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('ins')['corsoDiLaureaId'], ENT_QUOTES, 'UTF-8', true);?>
"
                                    <?php if ($_smarty_tpl->getValue('filtri')['insegnamento'] == $_smarty_tpl->getValue('ins')['id']) {?>selected<?php }?>>
                                <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('ins')['nome'], ENT_QUOTES, 'UTF-8', true);?>

                            </option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>
                </div>

                <!-- Tag -->
                <div class="filter-pill <?php if ($_smarty_tpl->getValue('filtri')['tag']) {?>filter-pill--active<?php }?>">
                    <select name="tag" class="filter-pill__select">
                        <option value="">Tag</option>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('tags'), 'tag');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('tag')->value) {
$foreach2DoElse = false;
?>
                            <option value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('tag')['id'], ENT_QUOTES, 'UTF-8', true);?>
"
                                <?php if ($_smarty_tpl->getValue('filtri')['tag'] == $_smarty_tpl->getValue('tag')['id']) {?>selected<?php }?>>
                                <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('tag')['nome'], ENT_QUOTES, 'UTF-8', true);?>

                            </option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>
                </div>

                <!-- Tipologia -->
                <div class="filter-pill <?php if ($_smarty_tpl->getValue('filtri')['tipologia']) {?>filter-pill--active<?php }?>">
                    <select name="tipologia" class="filter-pill__select">
                        <option value="">Tipologia</option>

                        <option value="appunto"
                            <?php if ($_smarty_tpl->getValue('filtri')['tipologia'] == 'appunto') {?>selected<?php }?>>
                            Appunto
                        </option>

                        <option value="esame"
                            <?php if ($_smarty_tpl->getValue('filtri')['tipologia'] == 'esame') {?>selected<?php }?>>
                            Esame
                        </option>
                    </select>
                </div>

            </div>

            <button type="submit" class="btn-applica-filtri">
                Applica filtri
            </button>

        </form>

        <!-- Ordina per -->
        <div class="sort-bar">
            <span class="sort-bar__label">
                <svg class="sort-bar__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><polyline points="5 12 12 5 19 12"/>
                    <line x1="12" y1="19" x2="12" y2="5"/><polyline points="19 12 12 19 5 12"/>
                </svg>
                Ordina per
            </span>

            <select name="ordinamento" form="filter-form" class="sort-bar__select">
                <option value="rilevanza"   <?php if ($_smarty_tpl->getValue('ordinamento') == 'rilevanza') {?>selected<?php }?>>Rilevanza</option>
                <option value="recente"     <?php if ($_smarty_tpl->getValue('ordinamento') == 'recente') {?>selected<?php }?>>Più recente</option>
                <option value="scaricati"   <?php if ($_smarty_tpl->getValue('ordinamento') == 'scaricati') {?>selected<?php }?>>Più scaricati</option>
                <option value="valutazione" <?php if ($_smarty_tpl->getValue('ordinamento') == 'valutazione') {?>selected<?php }?>>Valutazione</option>
            </select>
        </div>

    </div>
</section>
<!-- ===================== /FILTRI ===================== -->


<!-- ===================== RISULTATI ===================== -->
<section class="results-section">
    <div class="results-grid">

        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('materiali')) > 0) {?>

            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('materiali'), 'mat');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('mat')->value) {
$foreach3DoElse = false;
?>

                <a href="materiale.php?id=<?php echo rawurlencode((string)$_smarty_tpl->getValue('mat')['idMateriale']);?>
"
                   class="card"
                   aria-label="Apri <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('mat')['titolo'], ENT_QUOTES, 'UTF-8', true);?>
">

                    <div class="card__icon" aria-hidden="true">
                        <!-- SVG ICONA DOCUMENTO -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 96" fill="none">
                            <rect x="4" y="4" width="72" height="88" rx="6" ry="6"
                                  stroke="#1a1a2e" stroke-width="4" fill="white"/>
                            <path d="M52 4 L76 28" stroke="#1a1a2e" stroke-width="4"/>
                            <path d="M52 4 L52 28 L76 28" fill="#e8e0ff" stroke="#1a1a2e" stroke-width="4"
                                  stroke-linejoin="round"/>
                            <line x1="14" y1="44" x2="66" y2="44" stroke="#6c63ff" stroke-width="3.5" stroke-linecap="round"/>
                            <line x1="14" y1="56" x2="66" y2="56" stroke="#6c63ff" stroke-width="3.5" stroke-linecap="round"/>
                            <line x1="14" y1="68" x2="50" y2="68" stroke="#6c63ff" stroke-width="3.5" stroke-linecap="round"/>
                        </svg>
                    </div>

                    <div class="card__body">
                        <h2 class="card__title"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('mat')['titolo'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
                        <p class="card__meta"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('mat')['insegnamento'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                        <p class="card__meta"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('mat')['corsoDiLaurea'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                        <p class="card__meta card__meta--tipo"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('mat')['tipologia'], ENT_QUOTES, 'UTF-8', true);?>
</p>

                        <div class="card__rating" aria-label="Valutazione: <?php echo $_smarty_tpl->getValue('mat')['valutazione'];?>
 su 5">
                            <?php
$_smarty_tpl->tpl_vars['__smarty_section_s'] = new \Smarty\Variable(array());
if (true) {
for ($__section_s_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_s']->value['index'] = 0; $__section_s_0_iteration <= 5; $__section_s_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_s']->value['index']++){
?>
                                <?php if (($_smarty_tpl->getValue('__smarty_section_s')['index'] ?? null) < $_smarty_tpl->getValue('mat')['valutazione']) {?>
                                    <span class="star star--full">★</span>
                                <?php } else { ?>
                                    <span class="star star--empty">★</span>
                                <?php }?>
                            <?php
}
}
?>
                            <span class="card__rating-count">(<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('mat')['numValutazioni'], ENT_QUOTES, 'UTF-8', true);?>
)</span>
                        </div>

                        <div class="card__downloads" aria-label="<?php echo $_smarty_tpl->getValue('mat')['numDownload'];?>
 download">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="7 10 12 15 17 10"/>
                                <line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                            <span><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('mat')['numDownload'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                        </div>
                    </div>

                </a>

            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

        <?php } else { ?>

            <div class="results-empty">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    <line x1="8" y1="11" x2="14" y2="11"/>
                </svg>
                <p>Nessun materiale trovato per la tua ricerca.</p>
                <span>Prova a modificare i filtri o la parola chiave.</span>
            </div>

        <?php }?>

    </div>
</section>
<!-- ===================== /RISULTATI ===================== -->


<!-- ===================== PAGINAZIONE ===================== -->
<?php if ($_smarty_tpl->getValue('totalePagine') > 1) {?>
<nav class="pagination" aria-label="Navigazione pagine">

        <?php if ($_smarty_tpl->getValue('paginaCorrente') > 1) {?>
        <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('urlBasePagina'), ENT_QUOTES, 'UTF-8', true);?>
&amp;page=<?php echo $_smarty_tpl->getValue('paginaCorrente')-1;?>
"
           class="pagination__btn pagination__btn--prev"
           aria-label="Pagina precedente">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
        </a>
    <?php } else { ?>
        <span class="pagination__btn pagination__btn--prev pagination__btn--disabled" aria-disabled="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
        </span>
    <?php }?>

        <?php $_smarty_tpl->assign('winStart', $_smarty_tpl->getValue('paginaCorrente')-2, false, NULL);?>
    <?php $_smarty_tpl->assign('winEnd', $_smarty_tpl->getValue('paginaCorrente')+2, false, NULL);?>
    <?php if ($_smarty_tpl->getValue('winStart') < 1) {
$_smarty_tpl->assign('winStart', 1, false, NULL);
}?>
    <?php if ($_smarty_tpl->getValue('winEnd') > $_smarty_tpl->getValue('totalePagine')) {
$_smarty_tpl->assign('winEnd', $_smarty_tpl->getValue('totalePagine'), false, NULL);
}?>

        <?php if ($_smarty_tpl->getValue('winStart') > 1) {?>
        <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('urlBasePagina'), ENT_QUOTES, 'UTF-8', true);?>
&amp;page=1"
           class="pagination__page <?php if ($_smarty_tpl->getValue('paginaCorrente') == 1) {?>pagination__page--active<?php }?>">1</a>
        <?php if ($_smarty_tpl->getValue('winStart') > 2) {?>
            <span class="pagination__ellipsis">…</span>
        <?php }?>
    <?php }?>

        <?php
$_smarty_tpl->assign('p', null);$_smarty_tpl->tpl_vars['p']->step = 1;$_smarty_tpl->tpl_vars['p']->total = (int) ceil(($_smarty_tpl->tpl_vars['p']->step > 0 ? $_smarty_tpl->getValue('winEnd')+1 - ($_smarty_tpl->getValue('winStart')) : $_smarty_tpl->getValue('winStart')-($_smarty_tpl->getValue('winEnd'))+1)/abs($_smarty_tpl->tpl_vars['p']->step));
if ($_smarty_tpl->tpl_vars['p']->total > 0) {
for ($_smarty_tpl->tpl_vars['p']->value = $_smarty_tpl->getValue('winStart'), $_smarty_tpl->tpl_vars['p']->iteration = 1;$_smarty_tpl->tpl_vars['p']->iteration <= $_smarty_tpl->tpl_vars['p']->total;$_smarty_tpl->tpl_vars['p']->value += $_smarty_tpl->tpl_vars['p']->step, $_smarty_tpl->tpl_vars['p']->iteration++) {
$_smarty_tpl->tpl_vars['p']->first = $_smarty_tpl->tpl_vars['p']->iteration === 1;$_smarty_tpl->tpl_vars['p']->last = $_smarty_tpl->tpl_vars['p']->iteration === $_smarty_tpl->tpl_vars['p']->total;?>
        <?php if ($_smarty_tpl->getValue('p') == $_smarty_tpl->getValue('paginaCorrente')) {?>
            <span class="pagination__page pagination__page--active" aria-current="page"><?php echo $_smarty_tpl->getValue('p');?>
</span>
        <?php } else { ?>
            <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('urlBasePagina'), ENT_QUOTES, 'UTF-8', true);?>
&amp;page=<?php echo $_smarty_tpl->getValue('p');?>
"
               class="pagination__page"><?php echo $_smarty_tpl->getValue('p');?>
</a>
        <?php }?>
    <?php }
}
?>

        <?php if ($_smarty_tpl->getValue('winEnd') < $_smarty_tpl->getValue('totalePagine')) {?>
        <?php if ($_smarty_tpl->getValue('winEnd') < $_smarty_tpl->getValue('totalePagine')-1) {?>
            <span class="pagination__ellipsis">…</span>
        <?php }?>
        <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('urlBasePagina'), ENT_QUOTES, 'UTF-8', true);?>
&amp;page=<?php echo $_smarty_tpl->getValue('totalePagine');?>
"
           class="pagination__page <?php if ($_smarty_tpl->getValue('paginaCorrente') == $_smarty_tpl->getValue('totalePagine')) {?>pagination__page--active<?php }?>">
            <?php echo $_smarty_tpl->getValue('totalePagine');?>

        </a>
    <?php }?>

        <?php if ($_smarty_tpl->getValue('paginaCorrente') < $_smarty_tpl->getValue('totalePagine')) {?>
        <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('urlBasePagina'), ENT_QUOTES, 'UTF-8', true);?>
&amp;page=<?php echo $_smarty_tpl->getValue('paginaCorrente')+1;?>
"
           class="pagination__btn pagination__btn--next"
           aria-label="Pagina successiva">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </a>
    <?php } else { ?>
        <span class="pagination__btn pagination__btn--next pagination__btn--disabled" aria-disabled="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </span>
    <?php }?>

</nav>
<?php }?>
<!-- ===================== /PAGINAZIONE ===================== -->

<?php
}
}
/* {/block "content"} */
}
