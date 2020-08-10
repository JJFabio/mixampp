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

/* settings/signup.html */
class __TwigTemplate_dc041c4cb0c2b37bd1f800bc03b2ecb49c387641fd841b2af9b391edc7aabc02 extends \MailPoetVendor\Twig\Template
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
  <tbody>
    <!-- enable sign-up confirmation -->
    <tr>
      <th scope=\"row\">
        <label>
          ";
        // line 7
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Enable sign-up confirmation");
        echo "
        </label>
        <p class=\"description\">
          ";
        // line 10
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("If you enable this option, your subscribers will first receive a confirmation email after they subscribe. Once they confirm their subscription (via this email), they will be marked as 'confirmed' and will begin to receive your email newsletters.");
        echo "
          <a href=\"http://docs.mailpoet.com/article/128-why-you-should-use-signup-confirmation-double-opt-in\" target=\"_blank\">";
        // line 11
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Read more about Double Opt-in confirmation.");
        echo "</a>
        </p>
      </th>
      <td>
        <p
          id=\"mailpoet_signup_confirmation_notice\"
          ";
        // line 17
        if (($this->getAttribute(($context["settings"] ?? null), "mta_group", []) != "mailpoet")) {
            echo "style=\"display:none;\"";
        }
        // line 18
        echo "        >";
        // line 19
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Sign-up confirmation is mandatory when using the MailPoet Sending Service.");
        // line 20
        echo "</p>
        <p
          id=\"mailpoet_signup_confirmation_input\"
          ";
        // line 23
        if (($this->getAttribute(($context["settings"] ?? null), "mta_group", []) == "mailpoet")) {
            echo "style=\"display:none;\"";
        }
        // line 24
        echo "        >
          <label>
            <input
              type=\"radio\"
              class=\"mailpoet_signup_confirmation\"
              data-automation-id=\"enable_signup_confirmation\"
              name=\"signup_confirmation[enabled]\"
              value=\"1\"
              ";
        // line 32
        if ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "signup_confirmation", []), "enabled", [])) {
            // line 33
            echo "                checked=\"checked\"
              ";
        }
        // line 35
        echo "            />";
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Yes");
        echo "
          </label>
          &nbsp;
          <label>
            <input
              type=\"radio\"
              class=\"mailpoet_signup_confirmation\"
              data-automation-id=\"disable_signup_confirmation\"
              name=\"signup_confirmation[enabled]\"
              value=\"\"
              ";
        // line 45
        if ( !$this->getAttribute($this->getAttribute(($context["settings"] ?? null), "signup_confirmation", []), "enabled", [])) {
            // line 46
            echo "                checked=\"checked\"
              ";
        }
        // line 48
        echo "            />";
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("No");
        echo "
          </label>
        </p>
      </td>
    </tr>
  </tbody>
</table>
<table id=\"mailpoet_signup_options\" class=\"form-table\">
  <tbody>
    <!-- sign-up confirmation: from name & email -->
    <tr id=\"settings_signup_confirmation_sender_container\"></tr>
    <!-- sign-up confirmation: reply_to name & email -->
    <tr>
      <th scope=\"row\">
        <label for=\"settings[signup_confirmation_reply_name]\">
          ";
        // line 63
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Reply-to");
        echo "
        </label>
      </th>
      <td>
        <p>
          <input
            type=\"text\"
            id=\"settings[signup_confirmation_reply_name]\"
            name=\"signup_confirmation[reply_to][name]\"
            value=\"";
        // line 72
        echo \MailPoetVendor\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "signup_confirmation", []), "reply_to", []), "name", []), "html", null, true);
        echo "\"
            placeholder=\"";
        // line 73
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Your name");
        echo "\"
            />
          <input type=\"email\"
            id=\"settings[signup_confirmation_reply_email]\"
            name=\"signup_confirmation[reply_to][address]\"
            value=\"";
        // line 78
        echo \MailPoetVendor\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "signup_confirmation", []), "reply_to", []), "address", []), "html", null, true);
        echo "\"
            placeholder=\"confirmation@mydomain.com\"
            size=\"28\"
            />
        </p>
      </td>
    </tr>
    <!-- confirmation email: title -->
    <tr>
      <th scope=\"row\">
        <label for=\"settings[signup_confirmation_email_subject]\">
        ";
        // line 89
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Email subject");
        echo "
        </label>
      </th>
      <td>
        <input
          size=\"52\"
          type=\"text\"
          id=\"settings[signup_confirmation_email_subject]\"
          data-automation-id=\"signup_confirmation_email_subject\"
          name=\"signup_confirmation[subject]\"
          ";
        // line 99
        if ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "signup_confirmation", []), "subject", [])) {
            // line 100
            echo "            value=\"";
            echo \MailPoetVendor\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "signup_confirmation", []), "subject", []), "html", null, true);
            echo "\"
          ";
        }
        // line 102
        echo "        />
      </td>
    </tr>
    <!-- confirmation email: body -->
    <tr>
      <th scope=\"row\">
        <label for=\"settings[signup_confirmation_email_body]\">
          ";
        // line 109
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Email content");
        echo "
        </label>
        <p class=\"description\">
          ";
        // line 112
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Don't forget to include:<br /><br />[activation_link]Confirm your subscription.[/activation_link]<br /><br />Optional: [lists_to_confirm].");
        echo "
        </p>
      </th>
      <td>
        <textarea
          cols=\"50\"
          rows=\"15\"
          id=\"settings[signup_confirmation_email_body]\"
          data-automation-id=\"signup_confirmation_email_body\"
          name=\"signup_confirmation[body]\"
        >";
        // line 122
        if ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "signup_confirmation", []), "body", [])) {
            // line 123
            echo \MailPoetVendor\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "signup_confirmation", []), "body", []), "html", null, true);
        }
        // line 124
        echo "</textarea>
      </td>
    </tr>
    <!-- sign-up confirmation: confirmation page -->
    <tr>
      <th scope=\"row\">
        <label>
          ";
        // line 131
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Confirmation page");
        echo "
        </label>
        <p class=\"description\">
          ";
        // line 134
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("When subscribers click on the activation link, they will be redirected to this page.");
        echo "
        </p>
      </th>
      <td>
        <p>
          <select
            class=\"mailpoet_page_selection\"
            data-automation-id=\"page_selection\"
            name=\"subscription[pages][confirmation]\"
          >
            ";
        // line 144
        $context['_parent'] = $context;
        $context['_seq'] = \MailPoetVendor\twig_ensure_traversable(($context["pages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
            // line 145
            echo "              <option
                value=\"";
            // line 146
            echo \MailPoetVendor\twig_escape_filter($this->env, $this->getAttribute($context["page"], "id", []), "html", null, true);
            echo "\"
                data-preview-url=\"";
            // line 147
            echo $this->getAttribute($this->getAttribute($context["page"], "url", []), "confirm", []);
            echo "\"
                ";
            // line 148
            if (($this->getAttribute($context["page"], "id", []) == $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "subscription", []), "pages", []), "confirmation", []))) {
                // line 149
                echo "                  selected=\"selected\"
                ";
            }
            // line 151
            echo "              >";
            echo \MailPoetVendor\twig_escape_filter($this->env, $this->getAttribute($context["page"], "title", []), "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 153
        echo "          </select>
          <a
            class=\"mailpoet_page_preview\"
            data-automation-id=\"preview_page_link\"
            href=\"javascript:;\"
            title=\"";
        // line 158
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Preview page");
        echo "\"
          >";
        // line 159
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Preview");
        echo "</a>
        </p>
      </td>
    </tr>
  </tbody>
</table>

<script type=\"text/javascript\">
  jQuery(function(\$) {
    // om dom loaded
    \$(function() {
      // double optin toggling
      toggleSignupOptions();

      \$('.mailpoet_signup_confirmation').on('click', function() {
        var result = false;

        if(~~(\$(this).val()) === 1) {
          result = confirm(\"";
        // line 177
        echo \MailPoetVendor\twig_escape_filter($this->env, \MailPoetVendor\twig_escape_filter($this->env, $this->env->getExtension('MailPoet\Twig\I18n')->translate("Subscribers will need to activate their subscription via email in order to receive your newsletters. This is highly recommended!"), "js"), "html", null, true);
        echo "\");
        } else {
          result = confirm(\"";
        // line 179
        echo \MailPoetVendor\twig_escape_filter($this->env, \MailPoetVendor\twig_escape_filter($this->env, $this->env->getExtension('MailPoet\Twig\I18n')->translate("New subscribers will be automatically confirmed, without having to confirm their subscription. This is not recommended!"), "js"), "html", null, true);
        echo "\");
        }
        // if the user confirmed changing the sign-up confirmation (yes/no)
        if(result === true) {
          // toggle signup options depending on the currently selected value
          toggleSignupOptions();
        }
        return result;
      });

      function toggleSignupOptions() {
        var is_enabled =
          (~~(\$('.mailpoet_signup_confirmation:checked').val()) === 1);
        \$('#mailpoet_signup_options')[(is_enabled) ? 'show' : 'hide']();
      }
    });
  });
</script>
";
    }

    public function getTemplateName()
    {
        return "settings/signup.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  316 => 179,  311 => 177,  290 => 159,  286 => 158,  279 => 153,  270 => 151,  266 => 149,  264 => 148,  260 => 147,  256 => 146,  253 => 145,  249 => 144,  236 => 134,  230 => 131,  221 => 124,  218 => 123,  216 => 122,  203 => 112,  197 => 109,  188 => 102,  182 => 100,  180 => 99,  167 => 89,  153 => 78,  145 => 73,  141 => 72,  129 => 63,  110 => 48,  106 => 46,  104 => 45,  90 => 35,  86 => 33,  84 => 32,  74 => 24,  70 => 23,  65 => 20,  63 => 19,  61 => 18,  57 => 17,  48 => 11,  44 => 10,  38 => 7,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "settings/signup.html", "/home/inearsesde/www/wp-content/plugins/mailpoet/views/settings/signup.html");
    }
}
