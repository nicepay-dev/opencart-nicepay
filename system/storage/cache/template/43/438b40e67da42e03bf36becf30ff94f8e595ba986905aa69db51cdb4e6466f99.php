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

/* extension/payment/nicepay_va.twig */
class __TwigTemplate_8f014721d4c4c5c691525904b2cda8d9671d936b16a1aac4d4b45fe0d927efbb extends \Twig\Template
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
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"submit\" form=\"form-payment\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
      <h1>";
        // line 8
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 11
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 11);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 11);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
    ";
        // line 17
        if (($context["error_warning"] ?? null)) {
            // line 18
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 22
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 24
        echo ($context["text_edit"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 27
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-payment\" class=\"form-horizontal\">
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-merchant-id\"><span data-toggle=\"tooltip\" title=\"";
        // line 29
        echo ($context["help_merchant_id"] ?? null);
        echo "\">";
        echo ($context["entry_merchant_id"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_nicepay_va_merchant_id\" value=\"";
        // line 31
        echo ($context["payment_nicepay_va_merchant_id"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_merchant_id"] ?? null);
        echo "\" id=\"input-merchant-id\" class=\"form-control\" />
              ";
        // line 32
        if (($context["error_merchant_id"] ?? null)) {
            // line 33
            echo "              <div class=\"text-danger\">";
            echo ($context["error_merchant_id"] ?? null);
            echo "</div>
              ";
        }
        // line 35
        echo "            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-merchant-key\"><span data-toggle=\"tooltip\" title=\"";
        // line 38
        echo ($context["help_merchant_key"] ?? null);
        echo "\">";
        echo ($context["entry_merchant_key"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_nicepay_va_merchant_key\" value=\"";
        // line 40
        echo ($context["payment_nicepay_va_merchant_key"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_merchant_key"] ?? null);
        echo "\" id=\"input-merchant-key\" class=\"form-control\" />
              ";
        // line 41
        if (($context["error_merchant_key"] ?? null)) {
            // line 42
            echo "              <div class=\"text-danger\">";
            echo ($context["error_merchant_key"] ?? null);
            echo "</div>
              ";
        }
        // line 44
        echo "            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-rate\"><span data-toggle=\"tooltip\" title=\"";
        // line 47
        echo ($context["help_rate"] ?? null);
        echo "\">";
        echo ($context["entry_rate"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_nicepay_va_rate\" value=\"";
        // line 49
        echo ($context["payment_nicepay_va_rate"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_rate"] ?? null);
        echo "\" id=\"input-rate\" class=\"form-control\" />
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-invoice\">";
        // line 53
        echo ($context["entry_invoice"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_nicepay_va_invoice\" value=\"";
        // line 55
        echo ($context["payment_nicepay_va_invoice"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_invoice"] ?? null);
        echo "\" id=\"input-invoice\" class=\"form-control\" />
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-total\"><span data-toggle=\"tooltip\" title=\"";
        // line 59
        echo ($context["help_total"] ?? null);
        echo "\">";
        echo ($context["entry_total"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_nicepay_va_total\" value=\"";
        // line 61
        echo ($context["payment_nicepay_va_total"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_total"] ?? null);
        echo "\" id=\"input-total\" class=\"form-control\" />
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-order-status\"><span data-toggle=\"tooltip\" title=\"";
        // line 65
        echo ($context["help_order_status"] ?? null);
        echo "\">";
        echo ($context["entry_order_status"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <select name=\"payment_nicepay_va_order_status_id\" id=\"input-order-status\" class=\"form-control\">
                ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 69
            echo "                ";
            if ((twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 69) == ($context["payment_nicepay_va_order_status_id"] ?? null))) {
                // line 70
                echo "                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 70);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 70);
                echo "</option>
                ";
            } else {
                // line 72
                echo "                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 72);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 72);
                echo "</option>
                ";
            }
            // line 74
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        echo "              </select>
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-order-success-status\"><span data-toggle=\"tooltip\" title=\"";
        // line 79
        echo ($context["help_order_success_status"] ?? null);
        echo "\">";
        echo ($context["entry_order_success_status"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <select name=\"payment_nicepay_va_order_success_status\" id=\"input-order-success-status\" class=\"form-control\">
                ";
        // line 82
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 83
            echo "                ";
            if ((twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 83) == ($context["payment_nicepay_va_order_success_status"] ?? null))) {
                // line 84
                echo "                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 84);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 84);
                echo "</option>
                ";
            } else {
                // line 86
                echo "                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 86);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 86);
                echo "</option>
                ";
            }
            // line 88
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 89
        echo "              </select>
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-geo-zone\">";
        // line 93
        echo ($context["entry_geo_zone"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"payment_nicepay_va_geo_zone_id\" id=\"input-geo-zone\" class=\"form-control\">
                <option value=\"0\">";
        // line 96
        echo ($context["text_all_zones"] ?? null);
        echo "</option>
                ";
        // line 97
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["geo_zones"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["geo_zone"]) {
            // line 98
            echo "                ";
            if ((twig_get_attribute($this->env, $this->source, $context["geo_zone"], "geo_zone_id", [], "any", false, false, false, 98) == ($context["payment_nicepay_va_geo_zone_id"] ?? null))) {
                // line 99
                echo "                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["geo_zone"], "geo_zone_id", [], "any", false, false, false, 99);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["geo_zone"], "name", [], "any", false, false, false, 99);
                echo "</option>
                ";
            } else {
                // line 101
                echo "                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["geo_zone"], "geo_zone_id", [], "any", false, false, false, 101);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["geo_zone"], "name", [], "any", false, false, false, 101);
                echo "</option>
                ";
            }
            // line 103
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['geo_zone'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 104
        echo "              </select>
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-status\">";
        // line 108
        echo ($context["entry_status"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"payment_nicepay_va_status\" id=\"input-status\" class=\"form-control\">
                ";
        // line 111
        if (($context["payment_nicepay_va_status"] ?? null)) {
            // line 112
            echo "                <option value=\"1\" selected=\"selected\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                <option value=\"0\">";
            // line 113
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                ";
        } else {
            // line 115
            echo "                <option value=\"1\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                <option value=\"0\" selected=\"selected\">";
            // line 116
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                ";
        }
        // line 118
        echo "              </select>
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-sort-order\">";
        // line 122
        echo ($context["entry_sort_order"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_nicepay_va_sort_order\" value=\"";
        // line 124
        echo ($context["payment_nicepay_va_sort_order"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_sort_order"] ?? null);
        echo "\" id=\"input-sort-order\" class=\"form-control\" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
";
        // line 132
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/payment/nicepay_va.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  388 => 132,  375 => 124,  370 => 122,  364 => 118,  359 => 116,  354 => 115,  349 => 113,  344 => 112,  342 => 111,  336 => 108,  330 => 104,  324 => 103,  316 => 101,  308 => 99,  305 => 98,  301 => 97,  297 => 96,  291 => 93,  285 => 89,  279 => 88,  271 => 86,  263 => 84,  260 => 83,  256 => 82,  248 => 79,  242 => 75,  236 => 74,  228 => 72,  220 => 70,  217 => 69,  213 => 68,  205 => 65,  196 => 61,  189 => 59,  180 => 55,  175 => 53,  166 => 49,  159 => 47,  154 => 44,  148 => 42,  146 => 41,  140 => 40,  133 => 38,  128 => 35,  122 => 33,  120 => 32,  114 => 31,  107 => 29,  102 => 27,  96 => 24,  92 => 22,  84 => 18,  82 => 17,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/payment/nicepay_va.twig", "");
    }
}
