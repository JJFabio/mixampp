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

/* settings/woocommerce.html */
class __TwigTemplate_e4a13d86ef7062a52b4532aec34f8ed5682bae7188984102ea6055b4ca5724ab extends \MailPoetVendor\Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<table class=\"form-table\">
  <tr>
    <th scope=\"row\">
      <label for=\"settings[woocommerce_optin_on_checkout]\">
        ";
        // line 5
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Opt-in on checkout", "settings area: add an email opt-in checkbox on the checkout page (e-commerce websites)");
        echo "
      </label>
      <p class=\"description\">
        ";
        // line 8
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Customers can subscribe to the \"WooCommerce Customers\" list via a checkbox on the checkout page.");
        echo "
      </p>
    </th>
    <td>
      <p>
        <input
        data-toggle=\"mailpoet_woocommerce_optin_on_checkout\"
        type=\"checkbox\"
        value=\"1\"
        id=\"settings[woocommerce_optin_on_checkout]\"
        name=\"woocommerce[optin_on_checkout][enabled]\"
        ";
        // line 19
        if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "woocommerce", []), "optin_on_checkout", []), "enabled", [])) {
            echo "checked=\"checked\"";
        }
        // line 20
        echo "        >
      </p>
    </td>
  </tr>
  <tr id=\"mailpoet_woocommerce_optin_on_checkout\">
    <th scope=\"row\">
      <label for=\"settings[woocommerce_checkbox_optin_message]\">
        ";
        // line 27
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Checkbox opt-in message", "settings area: set the email opt-in message on the checkout page (e-commerce websites)");
        echo "
      </label>
      <p class=\"description\">
        ";
        // line 30
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("This is the checkbox message your customers will see on your WooCommerce checkout page to subscribe to the \"WooCommerce Customers\" list.");
        echo "
      </p>
    </th>
    <td>
      <p>
        <input type=\"text\"
          id=\"woocommerce_checkbox_optin_message\"
          name=\"woocommerce[optin_on_checkout][message]\"
          value=\"";
        // line 38
        echo \MailPoetVendor\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "woocommerce", []), "optin_on_checkout", []), "message", []), "html", null, true);
        echo "\"
          placeholder=\"";
        // line 39
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Checkbox opt-in message", "placeholder text for the WooCommerce checkout opt-in message");
        echo "\"
          class=\"regular-text\" />
          <br>
          <div id=\"settings_woocommerce_optin_on_checkout_error\" class=\"mailpoet_error_item mailpoet_error\">
            ";
        // line 43
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("The checkbox opt-in message cannot be empty.");
        echo "
          </div>
      </p>
    </td>
  </tr>
  <tr>
    <th scope=\"row\">
      <label for=\"settings[mailpoet_subscribe_old_woocommerce_customers]\">
        ";
        // line 51
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Subscribe old WooCommerce customers");
        echo "
      </label>
      <p class=\"description\">
        ";
        // line 54
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Subscribe all my past customers to this list because they agreed to receive marketing emails from me.");
        echo "
      </p>
    </th>
    <td>
      <p>
        <input
        type=\"checkbox\"
        value=\"1\"
        id=\"settings[mailpoet_subscribe_old_woocommerce_customers]\"
        name=\"mailpoet_subscribe_old_woocommerce_customers[enabled]\"
        ";
        // line 64
        if ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "mailpoet_subscribe_old_woocommerce_customers", []), "enabled", [])) {
            echo "checked=\"checked\"";
        }
        // line 65
        echo "        >
        ";
        // line 75
        echo "        <input
          type=\"hidden\"
          value=\"1\"
          name=\"mailpoet_subscribe_old_woocommerce_customers[dummy]\"
        >
      </p>
    </td>
  </tr>
  <tr>
    <th scope=\"row\">
      <label for=\"settings[mailpoet_accept_cookie_revenue_tracking]\">
        ";
        // line 86
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Enable browser cookies", "Option in settings page: the user can accept or forbid MailPoet to use browser cookies");
        echo "
      </label>
      <p class=\"description\">
        ";
        // line 89
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("If you enable this option, MailPoet will use browser cookies for more precise WooCommerce tracking. This is practical for abandoned cart emails for example.", "Browser cookies are data created by websites and stored in visitors web browser");
        echo "
      </p>
    </th>
    <td>
      <p>
        <input
          type=\"checkbox\"
          value=\"1\"
          id=\"settings[mailpoet_accept_cookie_revenue_tracking]\"
          data-automation-id=\"accept_cookie_revenue_tracking\"
          name=\"woocommerce[accept_cookie_revenue_tracking][enabled]\"
          ";
        // line 100
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "woocommerce", []), "accept_cookie_revenue_tracking", []), "enabled", []) == "1")) {
            echo "checked=\"checked\"";
        }
        // line 101
        echo "        >
        <input
          type=\"hidden\"
          value=\"1\"
          name=\"woocommerce[accept_cookie_revenue_tracking][set]\"
        >
      </p>
    </td>
  </tr>
</table>
";
    }

    public function getTemplateName()
    {
        return "settings/woocommerce.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  171 => 101,  167 => 100,  153 => 89,  147 => 86,  134 => 75,  131 => 65,  127 => 64,  114 => 54,  108 => 51,  97 => 43,  90 => 39,  86 => 38,  75 => 30,  69 => 27,  60 => 20,  56 => 19,  42 => 8,  36 => 5,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "settings/woocommerce.html", "/home/inearsesde/www/wp-content/plugins/mailpoet/views/settings/woocommerce.html");
    }
}
