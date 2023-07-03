<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* default/template/extension/payment/nicepay_va_success.twig */
class __TwigTemplate_f0ac9550b0f1cdbb3cdc2d43d96caaa2ce4d715a91cc3dd5bb6e7501498eedc1 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo ($context["header"] ?? null);
        echo ($context["column_left"] ?? null);
        echo "
<div id=\"content\" style=\"width: 60%; margin: auto\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <!-- <button type=\"submit\" onclick=\"\$('#form').submit();\" form=\"form-cod\" data-toggle=\"tooltip\" title=\"<?php echo \$button_save; ?>\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button> -->
        <a href=\"";
        // line 7
        echo ($context["continue"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"Continue to home\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a>
      </div>
      <h1>";
        // line 9
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 12
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 12);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 12);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo "        </ul>
      <div class=\"panel-body\">

        <table cellpadding=\"5\" border=\"0\" style=\"border-collapse:collapse;\" width=\"100%\" id=\"bayar\">
          <tr>
            <td width=\"200\"><b>Description</b></td><td>";
        // line 19
        echo ($context["description"] ?? null);
        echo "</td>
          </tr>
          <tr>
            <td><b>Bank</b></td><td>";
        // line 22
        echo ($context["bank_name"] ?? null);
        echo "</td>
          </tr>
          <tr>
            <td><b>Transaction ID</b></td><td>";
        // line 25
        echo ($context["transid"] ?? null);
        echo "</td>
          </tr>
          <tr>
          <tr>
            <td><b>Virtual Account</b></td><td>";
        // line 29
        echo ($context["virtual_account"] ?? null);
        echo "</td>
          </tr>
          <tr>
            <td><b>Total Ammount</b></td><td><b><i>";
        // line 32
        echo ($context["transamount"] ?? null);
        echo "</i></b></td>
          </tr>
          <tr>
            <td><b>Expired Date</b></td><td>";
        // line 35
        echo ($context["expired_date"] ?? null);
        echo "</td>
          </tr>
        </table>

        <br/>
        Pembayaran melalui Bank Transfer ";
        // line 40
        echo ($context["bank_name"] ?? null);
        echo " dapat dilakukan dengan mengikuti petunjuk berikut :
        <br/>
        <br/>
        ";
        // line 43
        echo ($context["bank_content"] ?? null);
        echo "
        <br/>
        ";
        // line 45
        echo ($context["text_message"] ?? null);
        echo "
        
      </div>
    </div>
  </div>

  <style>
  #bayar tr td{ padding-left: 1%; border: 1px inset #cccccc }
  </style>
</div>
";
        // line 55
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "default/template/extension/payment/nicepay_va_success.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  142 => 55,  129 => 45,  124 => 43,  118 => 40,  110 => 35,  104 => 32,  98 => 29,  91 => 25,  85 => 22,  79 => 19,  72 => 14,  61 => 12,  57 => 11,  52 => 9,  47 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/extension/payment/nicepay_va_success.twig", "");
    }
}
