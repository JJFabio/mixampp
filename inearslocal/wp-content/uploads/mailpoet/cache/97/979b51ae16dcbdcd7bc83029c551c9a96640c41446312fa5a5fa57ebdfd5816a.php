<?php

use MailPoetVendor\Twig\Environment;
use MailPoetVendor\Twig\Error\LoaderError;
use MailPoetVendor\Twig\Error\RuntimeError;
use MailPoetVendor\Twig\Markup;
use MailPoetVendor\Twig\Sandbox\SecurityError;
use MailPoetVendor\Twig\Sandbox\SecurityNotAllowedTagError;
use MailPoetVendor\Twig\Sandbox\SecurityNotAllowedFilterError;
use MailPoetVendor\Twig\Sandbox\SecurityNotAllowedFunctionError;
use MailPoetVendor\Twig\Source;
use MailPoetVendor\Twig\Template;

/* forms.html */
class __TwigTemplate_6c234487fae889d5f3e349288ed9bbc2c751d3baace69a176eb7d89ba89b69aa extends \MailPoetVendor\Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html", "forms.html", 1);
        $this->blocks = [
            'content' => [$this, 'block_content'],
            'translations' => [$this, 'block_translations'],
            'after_javascript' => [$this, 'block_after_javascript'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "layout.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        // line 4
        echo "  <div id=\"forms_container\"></div>

  <div>
    <p class=\"mailpoet_sending_methods_help help\">
      ";
        // line 8
        echo MailPoet\Util\Helpers::replaceLinkTags($this->env->getExtension('MailPoet\Twig\I18n')->translate("<strong>Tip:</strong> we have a [link]list of plugins[/link] that work with MailPoet if you need fancier forms."), "http://beta.docs.mailpoet.com/article/198-list-of-forms-plugins-that-work-with-mailpoet?utm_source=plugin&utm_medium=settings&utm_campaign=helpdocs", ["target" => "_blank", "id" => "mailpoet_helper_link"]);
        // line 11
        echo "
    </p>
  </div>

  ";
        // line 15
        $context["badgeClassName"] = (((($context["is_new_user"] ?? null) == true)) ? ("mailpoet_badge mailpoet_badge_video") : ("mailpoet_badge mailpoet_badge_video mailpoet_badge_video_grey"));
        // line 16
        echo "  <a class=\"";
        echo \MailPoetVendor\twig_escape_filter($this->env, ($context["badgeClassName"] ?? null), "html", null, true);
        echo "\" href=\"https://beta.docs.mailpoet.com/article/236-video-guide-setting-up-forms\" target=\"_blank\">
      <span class=\"dashicons dashicons-format-video\"></span>";
        // line 17
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("See video guide");
        echo "
  </a>

  <script type=\"text/javascript\">
    var mailpoet_listing_per_page = ";
        // line 21
        echo \MailPoetVendor\twig_escape_filter($this->env, ($context["items_per_page"] ?? null), "html", null, true);
        echo ";
    var mailpoet_segments = ";
        // line 22
        echo json_encode(($context["segments"] ?? null));
        echo ";
    var mailpoet_form_edit_url =
      \"";
        // line 24
        echo admin_url("admin.php?page=mailpoet-form-editor&id=");
        echo "\";
  </script>
";
    }

    // line 28
    public function block_translations($context, array $blocks = [])
    {
        // line 29
        echo "  ";
        echo $this->env->getExtension('MailPoet\Twig\I18n')->localize(["pageTitle" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Forms"), "searchLabel" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Search"), "loadingItems" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Loading forms..."), "noItemsFound" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("No forms were found. Why not create a new one?"), "selectAllLabel" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("All forms on this page are selected."), "selectedAllLabel" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("All %d forms are selected."), "selectAllLink" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Select all forms on all pages"), "clearSelection" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Clear selection"), "permanentlyDeleted" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("%d forms permanently deleted."), "selectBulkAction" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Select bulk action"), "bulkActions" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Bulk Actions"), "apply" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Apply"), "filter" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Filter"), "emptyTrash" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Empty Trash"), "selectAll" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Select All"), "restore" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Restore"), "deletePermanently" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Delete Permanently"), "previousPage" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Previous page"), "firstPage" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("First page"), "nextPage" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Next page"), "lastPage" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Last page"), "currentPage" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Current Page"), "pageOutOf" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("of"), "numberOfItemsSingular" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("1 item"), "numberOfItemsMultiple" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("%\$1d items"), "formName" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Name"), "segments" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Lists"), "userChoice" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("User choice:"), "signups" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Sign-ups"), "createdOn" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Created On"), "oneFormTrashed" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("1 form was moved to the trash."), "multipleFormsTrashed" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("%\$1d forms were moved to the trash."), "oneFormDeleted" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("1 form was permanently deleted."), "multipleFormsDeleted" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("%\$1d forms were permanently deleted."), "oneFormRestored" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("1 form has been restored from the trash."), "multipleFormsRestored" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("%\$1d forms have been restored from the trash."), "edit" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Edit"), "duplicate" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Duplicate"), "formDuplicated" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Form \"%\$1s\" has been duplicated."), "trash" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Trash"), "moveToTrash" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Move to trash"), "new" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Add New")]);
        // line 74
        echo "
";
    }

    // line 77
    public function block_after_javascript($context, array $blocks = [])
    {
        // line 78
        echo "<script type=\"text/javascript\">
  jQuery('#mailpoet_helper_link').on('click', function() {
    MailPoet.trackEvent('Forms page > link to doc page', {
      'MailPoet Free version': window.mailpoet_version
    });
  });
</script>
";
    }

    public function getTemplateName()
    {
        return "forms.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 78,  99 => 77,  94 => 74,  91 => 29,  88 => 28,  81 => 24,  76 => 22,  72 => 21,  65 => 17,  60 => 16,  58 => 15,  52 => 11,  50 => 8,  44 => 4,  41 => 3,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "forms.html", "/home/inearsesde/www/wp-content/plugins/mailpoet/views/forms.html");
    }
}
