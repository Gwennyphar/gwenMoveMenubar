{extends file="parent:frontend/index/index.tpl"}

{*show menubar in the navigation*}
{block name='frontend_index_navigation_categories_top'}
  {if {$gwen_move_menubar} == 0}
    <nav class="navigation-main">
      <div class="container" data-menu-scroller="true" data-listSelector=".navigation--list.container" data-viewPortSelector=".navigation--list-wrapper">
        {block name="frontend_index_navigation_categories_top_include"}
          {include file='frontend/index/main-navigation.tpl'}
        {/block}
      </div>
   </nav>
  {/if}
{/block}
	
{*show menubar in the header*}
{block name='frontend_index_navigation' prepend}
  {if {$gwen_move_menubar} == 1}
    <nav class="navigation-main topper">
      <div class="container" data-menu-scroller="true" data-listSelector=".navigation--list.container" data-viewPortSelector=".navigation--list-wrapper">
        {block name="frontend_index_navigation_categories_top_include"}
          {include file='frontend/index/main-navigation.tpl'}
        {/block}
      </div>
    </nav>
  {/if}
{/block}
  

{* disable Breadcrumb *}
{block name='frontend_index_breadcrumb'}
  {if $gwen_disabled_breadcrumbs == 0}
    {$smarty.block.parent}
  {/if}
{/block}