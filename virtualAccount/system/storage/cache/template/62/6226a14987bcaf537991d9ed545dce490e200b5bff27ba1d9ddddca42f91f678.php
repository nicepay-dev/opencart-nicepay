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

/* setting/setting.twig */
class __TwigTemplate_452a1d6393e2c6c3e6aad788752d33a724dc36c3eb9a2705841af813969be2c3 extends \Twig\Template
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
        <button type=\"submit\" id=\"button-save\" form=\"form-setting\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" disabled=\"disabled\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
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
  <div class=\"container-fluid\"> ";
        // line 16
        if (($context["error_warning"] ?? null)) {
            // line 17
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 21
        echo "    ";
        if (($context["success"] ?? null)) {
            // line 22
            echo "    <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 26
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 28
        echo ($context["text_edit"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 31
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-setting\" class=\"form-horizontal\">
          <ul class=\"nav nav-tabs\">
            <li class=\"active\"><a href=\"#tab-general\" data-toggle=\"tab\">";
        // line 33
        echo ($context["tab_general"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-store\" data-toggle=\"tab\">";
        // line 34
        echo ($context["tab_store"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-local\" data-toggle=\"tab\">";
        // line 35
        echo ($context["tab_local"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-option\" data-toggle=\"tab\">";
        // line 36
        echo ($context["tab_option"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-image\" data-toggle=\"tab\">";
        // line 37
        echo ($context["tab_image"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-mail\" data-toggle=\"tab\">";
        // line 38
        echo ($context["tab_mail"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-server\" data-toggle=\"tab\">";
        // line 39
        echo ($context["tab_server"] ?? null);
        echo "</a></li>
          </ul>
          <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"tab-general\">
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-meta-title\">";
        // line 44
        echo ($context["entry_meta_title"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_meta_title\" value=\"";
        // line 46
        echo ($context["config_meta_title"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_meta_title"] ?? null);
        echo "\" id=\"input-meta-title\" class=\"form-control\" />
                  ";
        // line 47
        if (($context["error_meta_title"] ?? null)) {
            // line 48
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_meta_title"] ?? null);
            echo "</div>
                  ";
        }
        // line 49
        echo " </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-meta-description\">";
        // line 52
        echo ($context["entry_meta_description"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"config_meta_description\" rows=\"5\" placeholder=\"";
        // line 54
        echo ($context["entry_meta_description"] ?? null);
        echo "\" id=\"input-meta-description\" class=\"form-control\">";
        echo ($context["config_meta_description"] ?? null);
        echo "</textarea>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-meta-keyword\">";
        // line 58
        echo ($context["entry_meta_keyword"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"config_meta_keyword\" rows=\"5\" placeholder=\"";
        // line 60
        echo ($context["entry_meta_keyword"] ?? null);
        echo "\" id=\"input-meta-keyword\" class=\"form-control\">";
        echo ($context["config_meta_keyword"] ?? null);
        echo "</textarea>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-theme\">";
        // line 64
        echo ($context["entry_theme"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_theme\" id=\"input-theme\" class=\"form-control\">
                    
                    ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["themes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
            // line 69
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["theme"], "value", [], "any", false, false, false, 69) == ($context["config_theme"] ?? null))) {
                // line 70
                echo "                    
                    <option value=\"";
                // line 71
                echo twig_get_attribute($this->env, $this->source, $context["theme"], "value", [], "any", false, false, false, 71);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["theme"], "text", [], "any", false, false, false, 71);
                echo "</option>
                    
                    ";
            } else {
                // line 74
                echo "                    
                    <option value=\"";
                // line 75
                echo twig_get_attribute($this->env, $this->source, $context["theme"], "value", [], "any", false, false, false, 75);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["theme"], "text", [], "any", false, false, false, 75);
                echo "</option>
                    
                    ";
            }
            // line 78
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 79
        echo "                  
                  </select>
                  <br />
                  <img src=\"\" alt=\"\" id=\"theme\" class=\"img-thumbnail\" /></div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-layout\">";
        // line 85
        echo ($context["entry_layout"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_layout_id\" id=\"input-layout\" class=\"form-control\">
                    
                    ";
        // line 89
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["layouts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout"]) {
            // line 90
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 90) == ($context["config_layout_id"] ?? null))) {
                // line 91
                echo "                    
                    <option value=\"";
                // line 92
                echo twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 92);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["layout"], "name", [], "any", false, false, false, 92);
                echo "</option>
                    
                    ";
            } else {
                // line 95
                echo "                    
                    <option value=\"";
                // line 96
                echo twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 96);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["layout"], "name", [], "any", false, false, false, 96);
                echo "</option>
                    
                    ";
            }
            // line 99
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 100
        echo "                  
                  </select>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-store\">
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-name\">";
        // line 107
        echo ($context["entry_name"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_name\" value=\"";
        // line 109
        echo ($context["config_name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_name"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" />
                  ";
        // line 110
        if (($context["error_name"] ?? null)) {
            // line 111
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_name"] ?? null);
            echo "</div>
                  ";
        }
        // line 112
        echo " </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-owner\">";
        // line 115
        echo ($context["entry_owner"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_owner\" value=\"";
        // line 117
        echo ($context["config_owner"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_owner"] ?? null);
        echo "\" id=\"input-owner\" class=\"form-control\" />
                  ";
        // line 118
        if (($context["error_owner"] ?? null)) {
            // line 119
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_owner"] ?? null);
            echo "</div>
                  ";
        }
        // line 120
        echo " </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-address\">";
        // line 123
        echo ($context["entry_address"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"config_address\" placeholder=\"";
        // line 125
        echo ($context["entry_address"] ?? null);
        echo "\" rows=\"5\" id=\"input-address\" class=\"form-control\">";
        echo ($context["config_address"] ?? null);
        echo "</textarea>
                  ";
        // line 126
        if (($context["error_address"] ?? null)) {
            // line 127
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_address"] ?? null);
            echo "</div>
                  ";
        }
        // line 128
        echo " </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-geocode\"><span data-toggle=\"tooltip\" data-container=\"#tab-general\" title=\"";
        // line 131
        echo ($context["help_geocode"] ?? null);
        echo "\">";
        echo ($context["entry_geocode"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_geocode\" value=\"";
        // line 133
        echo ($context["config_geocode"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_geocode"] ?? null);
        echo "\" id=\"input-geocode\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-email\">";
        // line 137
        echo ($context["entry_email"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_email\" value=\"";
        // line 139
        echo ($context["config_email"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_email"] ?? null);
        echo "\" id=\"input-email\" class=\"form-control\" />
                  ";
        // line 140
        if (($context["error_email"] ?? null)) {
            // line 141
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_email"] ?? null);
            echo "</div>
                  ";
        }
        // line 142
        echo " </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-telephone\">";
        // line 145
        echo ($context["entry_telephone"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_telephone\" value=\"";
        // line 147
        echo ($context["config_telephone"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_telephone"] ?? null);
        echo "\" id=\"input-telephone\" class=\"form-control\" />
                  ";
        // line 148
        if (($context["error_telephone"] ?? null)) {
            // line 149
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_telephone"] ?? null);
            echo "</div>
                  ";
        }
        // line 150
        echo " </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-fax\">";
        // line 153
        echo ($context["entry_fax"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"config_fax\" value=\"";
        // line 155
        echo ($context["config_fax"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_fax"] ?? null);
        echo "\" id=\"input-fax\" class=\"form-control\" />
                </div>
              </div>              
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-image\">";
        // line 159
        echo ($context["entry_image"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\"><a href=\"\" id=\"thumb-image\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 160
        echo ($context["thumb"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
                  <input type=\"hidden\" name=\"config_image\" value=\"";
        // line 161
        echo ($context["config_image"] ?? null);
        echo "\" id=\"input-image\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-open\"><span data-toggle=\"tooltip\" data-container=\"#tab-general\" title=\"";
        // line 165
        echo ($context["help_open"] ?? null);
        echo "\">";
        echo ($context["entry_open"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <textarea name=\"config_open\" rows=\"5\" placeholder=\"";
        // line 167
        echo ($context["entry_open"] ?? null);
        echo "\" id=\"input-open\" class=\"form-control\">";
        echo ($context["config_open"] ?? null);
        echo "</textarea>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-comment\"><span data-toggle=\"tooltip\" data-container=\"#tab-general\" title=\"";
        // line 171
        echo ($context["help_comment"] ?? null);
        echo "\">";
        echo ($context["entry_comment"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <textarea name=\"config_comment\" rows=\"5\" placeholder=\"";
        // line 173
        echo ($context["entry_comment"] ?? null);
        echo "\" id=\"input-comment\" class=\"form-control\">";
        echo ($context["config_comment"] ?? null);
        echo "</textarea>
                </div>
              </div>
              ";
        // line 176
        if (($context["locations"] ?? null)) {
            // line 177
            echo "              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" data-container=\"#tab-general\" title=\"";
            // line 178
            echo ($context["help_location"] ?? null);
            echo "\">";
            echo ($context["entry_location"] ?? null);
            echo "</span></label>
                <div class=\"col-sm-10\"> ";
            // line 179
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["locations"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["location"]) {
                // line 180
                echo "                  <div class=\"checkbox\">
                    <label> ";
                // line 181
                if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["location"], "location_id", [], "any", false, false, false, 181), ($context["config_location"] ?? null))) {
                    // line 182
                    echo "                      <input type=\"checkbox\" name=\"config_location[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "location_id", [], "any", false, false, false, 182);
                    echo "\" checked=\"checked\" />
                      ";
                    // line 183
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "name", [], "any", false, false, false, 183);
                    echo "
                      ";
                } else {
                    // line 185
                    echo "                      <input type=\"checkbox\" name=\"config_location[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "location_id", [], "any", false, false, false, 185);
                    echo "\" />
                      ";
                    // line 186
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "name", [], "any", false, false, false, 186);
                    echo "
                      ";
                }
                // line 187
                echo " </label>
                  </div>
                  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['location'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 189
            echo " </div>
              </div>
              ";
        }
        // line 191
        echo " </div>
            <div class=\"tab-pane\" id=\"tab-local\">
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-country\">";
        // line 194
        echo ($context["entry_country"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_country_id\" id=\"input-country\" class=\"form-control\">
                    
                    ";
        // line 198
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 199
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 199) == ($context["config_country_id"] ?? null))) {
                // line 200
                echo "                    
                    <option value=\"";
                // line 201
                echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 201);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 201);
                echo "</option>
                    
                    ";
            } else {
                // line 204
                echo "                    
                    <option value=\"";
                // line 205
                echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 205);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 205);
                echo "</option>
                    
                    ";
            }
            // line 208
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 209
        echo "                  
                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-zone\">";
        // line 214
        echo ($context["entry_zone"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_zone_id\" id=\"input-zone\" class=\"form-control\">
                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-language\">";
        // line 221
        echo ($context["entry_language"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_language\" id=\"input-language\" class=\"form-control\">
                    
                    ";
        // line 225
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 226
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 226) == ($context["config_language"] ?? null))) {
                // line 227
                echo "                    
                    <option value=\"";
                // line 228
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 228);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 228);
                echo "</option>
                    
                    ";
            } else {
                // line 231
                echo "                    
                    <option value=\"";
                // line 232
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 232);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 232);
                echo "</option>
                    
                    ";
            }
            // line 235
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 236
        echo "                  
                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-admin-language\">";
        // line 241
        echo ($context["entry_admin_language"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_admin_language\" id=\"input-admin-language\" class=\"form-control\">
                    
                    ";
        // line 245
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 246
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 246) == ($context["config_admin_language"] ?? null))) {
                // line 247
                echo "                    
                    <option value=\"";
                // line 248
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 248);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 248);
                echo "</option>
                    
                    ";
            } else {
                // line 251
                echo "                    
                    <option value=\"";
                // line 252
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 252);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 252);
                echo "</option>
                    
                    ";
            }
            // line 255
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 256
        echo "                  
                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-currency\"><span data-toggle=\"tooltip\" title=\"";
        // line 261
        echo ($context["help_currency"] ?? null);
        echo "\">";
        echo ($context["entry_currency"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <select name=\"config_currency\" id=\"input-currency\" class=\"form-control\">
                    
                    ";
        // line 265
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
            // line 266
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 266) == ($context["config_currency"] ?? null))) {
                // line 267
                echo "                    
                    <option value=\"";
                // line 268
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 268);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "title", [], "any", false, false, false, 268);
                echo "</option>
                    
                    ";
            } else {
                // line 271
                echo "                    
                    <option value=\"";
                // line 272
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 272);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "title", [], "any", false, false, false, 272);
                echo "</option>
                    
                    ";
            }
            // line 275
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 276
        echo "                  
                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 281
        echo ($context["help_currency_auto"] ?? null);
        echo "\">";
        echo ($context["entry_currency_auto"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <label class=\"radio-inline\"> ";
        // line 283
        if (($context["config_currency_auto"] ?? null)) {
            // line 284
            echo "                    <input type=\"radio\" name=\"config_currency_auto\" value=\"1\" checked=\"checked\" />
                    ";
            // line 285
            echo ($context["text_yes"] ?? null);
            echo "
                    ";
        } else {
            // line 287
            echo "                    <input type=\"radio\" name=\"config_currency_auto\" value=\"1\" />
                    ";
            // line 288
            echo ($context["text_yes"] ?? null);
            echo "
                    ";
        }
        // line 289
        echo " </label>
                  <label class=\"radio-inline\"> ";
        // line 290
        if ( !($context["config_currency_auto"] ?? null)) {
            // line 291
            echo "                    <input type=\"radio\" name=\"config_currency_auto\" value=\"0\" checked=\"checked\" />
                    ";
            // line 292
            echo ($context["text_no"] ?? null);
            echo "
                    ";
        } else {
            // line 294
            echo "                    <input type=\"radio\" name=\"config_currency_auto\" value=\"0\" />
                    ";
            // line 295
            echo ($context["text_no"] ?? null);
            echo "
                    ";
        }
        // line 296
        echo " </label>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-length-class\">";
        // line 300
        echo ($context["entry_length_class"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_length_class_id\" id=\"input-length-class\" class=\"form-control\">
                    
                    ";
        // line 304
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["length_classes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["length_class"]) {
            // line 305
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["length_class"], "length_class_id", [], "any", false, false, false, 305) == ($context["config_length_class_id"] ?? null))) {
                // line 306
                echo "                    
                    <option value=\"";
                // line 307
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "length_class_id", [], "any", false, false, false, 307);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "title", [], "any", false, false, false, 307);
                echo "</option>
                    
                    ";
            } else {
                // line 310
                echo "                    
                    <option value=\"";
                // line 311
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "length_class_id", [], "any", false, false, false, 311);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "title", [], "any", false, false, false, 311);
                echo "</option>
                    
                    ";
            }
            // line 314
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['length_class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 315
        echo "                  
                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-weight-class\">";
        // line 320
        echo ($context["entry_weight_class"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"config_weight_class_id\" id=\"input-weight-class\" class=\"form-control\">
                    
                    ";
        // line 324
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["weight_classes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["weight_class"]) {
            // line 325
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["weight_class"], "weight_class_id", [], "any", false, false, false, 325) == ($context["config_weight_class_id"] ?? null))) {
                // line 326
                echo "                    
                    <option value=\"";
                // line 327
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "weight_class_id", [], "any", false, false, false, 327);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "title", [], "any", false, false, false, 327);
                echo "</option>
                    
                    ";
            } else {
                // line 330
                echo "                    
                    <option value=\"";
                // line 331
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "weight_class_id", [], "any", false, false, false, 331);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "title", [], "any", false, false, false, 331);
                echo "</option>
                    
                    ";
            }
            // line 334
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['weight_class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 335
        echo "                  
                  </select>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-option\">
              <fieldset>
                <legend>";
        // line 342
        echo ($context["text_product"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 344
        echo ($context["help_product_count"] ?? null);
        echo "\">";
        echo ($context["entry_product_count"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 346
        if (($context["config_product_count"] ?? null)) {
            // line 347
            echo "                      <input type=\"radio\" name=\"config_product_count\" value=\"1\" checked=\"checked\" />
                      ";
            // line 348
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 350
            echo "                      <input type=\"radio\" name=\"config_product_count\" value=\"1\" />
                      ";
            // line 351
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 352
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 353
        if ( !($context["config_product_count"] ?? null)) {
            // line 354
            echo "                      <input type=\"radio\" name=\"config_product_count\" value=\"0\" checked=\"checked\" />
                      ";
            // line 355
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 357
            echo "                      <input type=\"radio\" name=\"config_product_count\" value=\"0\" />
                      ";
            // line 358
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 359
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-admin-limit\"><span data-toggle=\"tooltip\" title=\"";
        // line 363
        echo ($context["help_limit_admin"] ?? null);
        echo "\">";
        echo ($context["entry_limit_admin"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_limit_admin\" value=\"";
        // line 365
        echo ($context["config_limit_admin"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_limit_admin"] ?? null);
        echo "\" id=\"input-admin-limit\" class=\"form-control\" />
                    ";
        // line 366
        if (($context["error_limit_admin"] ?? null)) {
            // line 367
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_limit_admin"] ?? null);
            echo "</div>
                    ";
        }
        // line 368
        echo " </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 372
        echo ($context["text_review"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 374
        echo ($context["help_review"] ?? null);
        echo "\">";
        echo ($context["entry_review"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 376
        if (($context["config_review_status"] ?? null)) {
            // line 377
            echo "                      <input type=\"radio\" name=\"config_review_status\" value=\"1\" checked=\"checked\" />
                      ";
            // line 378
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 380
            echo "                      <input type=\"radio\" name=\"config_review_status\" value=\"1\" />
                      ";
            // line 381
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 382
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 383
        if ( !($context["config_review_status"] ?? null)) {
            // line 384
            echo "                      <input type=\"radio\" name=\"config_review_status\" value=\"0\" checked=\"checked\" />
                      ";
            // line 385
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 387
            echo "                      <input type=\"radio\" name=\"config_review_status\" value=\"0\" />
                      ";
            // line 388
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 389
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 393
        echo ($context["help_review_guest"] ?? null);
        echo "\">";
        echo ($context["entry_review_guest"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 395
        if (($context["config_review_guest"] ?? null)) {
            // line 396
            echo "                      <input type=\"radio\" name=\"config_review_guest\" value=\"1\" checked=\"checked\" />
                      ";
            // line 397
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 399
            echo "                      <input type=\"radio\" name=\"config_review_guest\" value=\"1\" />
                      ";
            // line 400
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 401
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 402
        if ( !($context["config_review_guest"] ?? null)) {
            // line 403
            echo "                      <input type=\"radio\" name=\"config_review_guest\" value=\"0\" checked=\"checked\" />
                      ";
            // line 404
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 406
            echo "                      <input type=\"radio\" name=\"config_review_guest\" value=\"0\" />
                      ";
            // line 407
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 408
        echo " </label>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 413
        echo ($context["text_voucher"] ?? null);
        echo "</legend>
                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-voucher-min\"><span data-toggle=\"tooltip\" title=\"";
        // line 415
        echo ($context["help_voucher_min"] ?? null);
        echo "\">";
        echo ($context["entry_voucher_min"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_voucher_min\" value=\"";
        // line 417
        echo ($context["config_voucher_min"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_voucher_min"] ?? null);
        echo "\" id=\"input-voucher-min\" class=\"form-control\" />
                    ";
        // line 418
        if (($context["error_voucher_min"] ?? null)) {
            // line 419
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_voucher_min"] ?? null);
            echo "</div>
                    ";
        }
        // line 420
        echo " </div>
                </div>
                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-voucher-max\"><span data-toggle=\"tooltip\" title=\"";
        // line 423
        echo ($context["help_voucher_max"] ?? null);
        echo "\">";
        echo ($context["entry_voucher_max"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_voucher_max\" value=\"";
        // line 425
        echo ($context["config_voucher_max"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_voucher_max"] ?? null);
        echo "\" id=\"input-voucher-max\" class=\"form-control\" />
                    ";
        // line 426
        if (($context["error_voucher_max"] ?? null)) {
            // line 427
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_voucher_max"] ?? null);
            echo "</div>
                    ";
        }
        // line 428
        echo " </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 432
        echo ($context["text_tax"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\">";
        // line 434
        echo ($context["entry_tax"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 436
        if (($context["config_tax"] ?? null)) {
            // line 437
            echo "                      <input type=\"radio\" name=\"config_tax\" value=\"1\" checked=\"checked\" />
                      ";
            // line 438
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 440
            echo "                      <input type=\"radio\" name=\"config_tax\" value=\"1\" />
                      ";
            // line 441
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 442
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 443
        if ( !($context["config_tax"] ?? null)) {
            // line 444
            echo "                      <input type=\"radio\" name=\"config_tax\" value=\"0\" checked=\"checked\" />
                      ";
            // line 445
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 447
            echo "                      <input type=\"radio\" name=\"config_tax\" value=\"0\" />
                      ";
            // line 448
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 449
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-tax-default\"><span data-toggle=\"tooltip\" title=\"";
        // line 453
        echo ($context["help_tax_default"] ?? null);
        echo "\">";
        echo ($context["entry_tax_default"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_tax_default\" id=\"input-tax-default\" class=\"form-control\">
                      <option value=\"\">";
        // line 456
        echo ($context["text_none"] ?? null);
        echo "</option>
                      
                      ";
        // line 458
        if ((($context["config_tax_default"] ?? null) == "shipping")) {
            // line 459
            echo "                      
                      <option value=\"shipping\" selected=\"selected\">";
            // line 460
            echo ($context["text_shipping"] ?? null);
            echo "</option>
                      
                      ";
        } else {
            // line 463
            echo "                      
                      <option value=\"shipping\">";
            // line 464
            echo ($context["text_shipping"] ?? null);
            echo "</option>
                      
                      ";
        }
        // line 467
        echo "                      ";
        if ((($context["config_tax_default"] ?? null) == "payment")) {
            // line 468
            echo "                      
                      <option value=\"payment\" selected=\"selected\">";
            // line 469
            echo ($context["text_payment"] ?? null);
            echo "</option>
                      
                      ";
        } else {
            // line 472
            echo "                      
                      <option value=\"payment\">";
            // line 473
            echo ($context["text_payment"] ?? null);
            echo "</option>
                      
                      ";
        }
        // line 476
        echo "                    
                    </select>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-tax-customer\"><span data-toggle=\"tooltip\" title=\"";
        // line 481
        echo ($context["help_tax_customer"] ?? null);
        echo "\">";
        echo ($context["entry_tax_customer"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_tax_customer\" id=\"input-tax-customer\" class=\"form-control\">
                      <option value=\"\">";
        // line 484
        echo ($context["text_none"] ?? null);
        echo "</option>
                      
                      ";
        // line 486
        if ((($context["config_tax_customer"] ?? null) == "shipping")) {
            // line 487
            echo "                      
                      <option value=\"shipping\" selected=\"selected\">";
            // line 488
            echo ($context["text_shipping"] ?? null);
            echo "</option>
                      
                      ";
        } else {
            // line 491
            echo "                      
                      <option value=\"shipping\">";
            // line 492
            echo ($context["text_shipping"] ?? null);
            echo "</option>
                      
                      ";
        }
        // line 495
        echo "                      ";
        if ((($context["config_tax_customer"] ?? null) == "payment")) {
            // line 496
            echo "                      
                      <option value=\"payment\" selected=\"selected\">";
            // line 497
            echo ($context["text_payment"] ?? null);
            echo "</option>
                      
                      ";
        } else {
            // line 500
            echo "                      
                      <option value=\"payment\">";
            // line 501
            echo ($context["text_payment"] ?? null);
            echo "</option>
                      
                      ";
        }
        // line 504
        echo "                    
                    </select>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 510
        echo ($context["text_account"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 512
        echo ($context["help_customer_online"] ?? null);
        echo "\">";
        echo ($context["entry_customer_online"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 514
        if (($context["config_customer_online"] ?? null)) {
            // line 515
            echo "                      <input type=\"radio\" name=\"config_customer_online\" value=\"1\" checked=\"checked\" />
                      ";
            // line 516
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 518
            echo "                      <input type=\"radio\" name=\"config_customer_online\" value=\"1\" />
                      ";
            // line 519
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 520
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 521
        if ( !($context["config_customer_online"] ?? null)) {
            // line 522
            echo "                      <input type=\"radio\" name=\"config_customer_online\" value=\"0\" checked=\"checked\" />
                      ";
            // line 523
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 525
            echo "                      <input type=\"radio\" name=\"config_customer_online\" value=\"0\" />
                      ";
            // line 526
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 527
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 531
        echo ($context["help_customer_activity"] ?? null);
        echo "\">";
        echo ($context["entry_customer_activity"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 533
        if (($context["config_customer_activity"] ?? null)) {
            // line 534
            echo "                      <input type=\"radio\" name=\"config_customer_activity\" value=\"1\" checked=\"checked\" />
                      ";
            // line 535
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 537
            echo "                      <input type=\"radio\" name=\"config_customer_activity\" value=\"1\" />
                      ";
            // line 538
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 539
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 540
        if ( !($context["config_customer_activity"] ?? null)) {
            // line 541
            echo "                      <input type=\"radio\" name=\"config_customer_activity\" value=\"0\" checked=\"checked\" />
                      ";
            // line 542
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 544
            echo "                      <input type=\"radio\" name=\"config_customer_activity\" value=\"0\" />
                      ";
            // line 545
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 546
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\">";
        // line 550
        echo ($context["entry_customer_search"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 552
        if (($context["config_customer_search"] ?? null)) {
            // line 553
            echo "                      <input type=\"radio\" name=\"config_customer_search\" value=\"1\" checked=\"checked\" />
                      ";
            // line 554
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 556
            echo "                      <input type=\"radio\" name=\"config_customer_search\" value=\"1\" />
                      ";
            // line 557
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 558
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 559
        if ( !($context["config_customer_search"] ?? null)) {
            // line 560
            echo "                      <input type=\"radio\" name=\"config_customer_search\" value=\"0\" checked=\"checked\" />
                      ";
            // line 561
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 563
            echo "                      <input type=\"radio\" name=\"config_customer_search\" value=\"0\" />
                      ";
            // line 564
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 565
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-customer-group\"><span data-toggle=\"tooltip\" title=\"";
        // line 569
        echo ($context["help_customer_group"] ?? null);
        echo "\">";
        echo ($context["entry_customer_group"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_customer_group_id\" id=\"input-customer-group\" class=\"form-control\">
                      
                      ";
        // line 573
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 574
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 574) == ($context["config_customer_group_id"] ?? null))) {
                // line 575
                echo "                      
                      <option value=\"";
                // line 576
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 576);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 576);
                echo "</option>
                      
                      ";
            } else {
                // line 579
                echo "                      
                      <option value=\"";
                // line 580
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 580);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 580);
                echo "</option>
                      
                      ";
            }
            // line 583
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 584
        echo "                    
                    </select>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 589
        echo ($context["help_customer_group_display"] ?? null);
        echo "\">";
        echo ($context["entry_customer_group_display"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\"> ";
        // line 590
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 591
            echo "                    <div class=\"checkbox\">
                      <label> ";
            // line 592
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 592), ($context["config_customer_group_display"] ?? null))) {
                // line 593
                echo "                        <input type=\"checkbox\" name=\"config_customer_group_display[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 593);
                echo "\" checked=\"checked\" />
                        ";
                // line 594
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 594);
                echo "
                        ";
            } else {
                // line 596
                echo "                        <input type=\"checkbox\" name=\"config_customer_group_display[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 596);
                echo "\" />
                        ";
                // line 597
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 597);
                echo "
                        ";
            }
            // line 598
            echo " </label>
                    </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 601
        echo "                    ";
        if (($context["error_customer_group_display"] ?? null)) {
            // line 602
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_customer_group_display"] ?? null);
            echo "</div>
                    ";
        }
        // line 603
        echo " </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 606
        echo ($context["help_customer_price"] ?? null);
        echo "\">";
        echo ($context["entry_customer_price"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 608
        if (($context["config_customer_price"] ?? null)) {
            // line 609
            echo "                      <input type=\"radio\" name=\"config_customer_price\" value=\"1\" checked=\"checked\" />
                      ";
            // line 610
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 612
            echo "                      <input type=\"radio\" name=\"config_customer_price\" value=\"1\" />
                      ";
            // line 613
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 614
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 615
        if ( !($context["config_customer_price"] ?? null)) {
            // line 616
            echo "                      <input type=\"radio\" name=\"config_customer_price\" value=\"0\" checked=\"checked\" />
                      ";
            // line 617
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 619
            echo "                      <input type=\"radio\" name=\"config_customer_price\" value=\"0\" />
                      ";
            // line 620
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 621
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-login-attempts\"><span data-toggle=\"tooltip\" title=\"";
        // line 625
        echo ($context["help_login_attempts"] ?? null);
        echo "\">";
        echo ($context["entry_login_attempts"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_login_attempts\" value=\"";
        // line 627
        echo ($context["config_login_attempts"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_login_attempts"] ?? null);
        echo "\" id=\"input-login-attempts\" class=\"form-control\" />
                    ";
        // line 628
        if (($context["error_login_attempts"] ?? null)) {
            // line 629
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_login_attempts"] ?? null);
            echo "</div>
                    ";
        }
        // line 630
        echo " </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-account\"><span data-toggle=\"tooltip\" title=\"";
        // line 633
        echo ($context["help_account"] ?? null);
        echo "\">";
        echo ($context["entry_account"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_account_id\" id=\"input-account\" class=\"form-control\">
                      <option value=\"0\">";
        // line 636
        echo ($context["text_none"] ?? null);
        echo "</option>
                      
                      ";
        // line 638
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
            // line 639
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 639) == ($context["config_account_id"] ?? null))) {
                // line 640
                echo "                      
                      <option value=\"";
                // line 641
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 641);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 641);
                echo "</option>
                      
                      ";
            } else {
                // line 644
                echo "                      
                      <option value=\"";
                // line 645
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 645);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 645);
                echo "</option>
                      
                      ";
            }
            // line 648
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 649
        echo "                    
                    </select>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 655
        echo ($context["text_checkout"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-invoice-prefix\"><span data-toggle=\"tooltip\" title=\"";
        // line 657
        echo ($context["help_invoice_prefix"] ?? null);
        echo "\">";
        echo ($context["entry_invoice_prefix"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_invoice_prefix\" value=\"";
        // line 659
        echo ($context["config_invoice_prefix"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_invoice_prefix"] ?? null);
        echo "\" id=\"input-invoice-prefix\" class=\"form-control\" />
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 663
        echo ($context["help_cart_weight"] ?? null);
        echo "\">";
        echo ($context["entry_cart_weight"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 665
        if (($context["config_cart_weight"] ?? null)) {
            // line 666
            echo "                      <input type=\"radio\" name=\"config_cart_weight\" value=\"1\" checked=\"checked\" />
                      ";
            // line 667
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 669
            echo "                      <input type=\"radio\" name=\"config_cart_weight\" value=\"1\" />
                      ";
            // line 670
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 671
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 672
        if ( !($context["config_cart_weight"] ?? null)) {
            // line 673
            echo "                      <input type=\"radio\" name=\"config_cart_weight\" value=\"0\" checked=\"checked\" />
                      ";
            // line 674
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 676
            echo "                      <input type=\"radio\" name=\"config_cart_weight\" value=\"0\" />
                      ";
            // line 677
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 678
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 682
        echo ($context["help_checkout_guest"] ?? null);
        echo "\">";
        echo ($context["entry_checkout_guest"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 684
        if (($context["config_checkout_guest"] ?? null)) {
            // line 685
            echo "                      <input type=\"radio\" name=\"config_checkout_guest\" value=\"1\" checked=\"checked\" />
                      ";
            // line 686
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 688
            echo "                      <input type=\"radio\" name=\"config_checkout_guest\" value=\"1\" />
                      ";
            // line 689
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 690
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 691
        if ( !($context["config_checkout_guest"] ?? null)) {
            // line 692
            echo "                      <input type=\"radio\" name=\"config_checkout_guest\" value=\"0\" checked=\"checked\" />
                      ";
            // line 693
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 695
            echo "                      <input type=\"radio\" name=\"config_checkout_guest\" value=\"0\" />
                      ";
            // line 696
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 697
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-checkout\"><span data-toggle=\"tooltip\" title=\"";
        // line 701
        echo ($context["help_checkout"] ?? null);
        echo "\">";
        echo ($context["entry_checkout"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_checkout_id\" id=\"input-checkout\" class=\"form-control\">
                      <option value=\"0\">";
        // line 704
        echo ($context["text_none"] ?? null);
        echo "</option>
                      
                      ";
        // line 706
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
            // line 707
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 707) == ($context["config_checkout_id"] ?? null))) {
                // line 708
                echo "                      
                      <option value=\"";
                // line 709
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 709);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 709);
                echo "</option>
                      
                      ";
            } else {
                // line 712
                echo "                      
                      <option value=\"";
                // line 713
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 713);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 713);
                echo "</option>
                      
                      ";
            }
            // line 716
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 717
        echo "                    
                    </select>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-order-status\"><span data-toggle=\"tooltip\" title=\"";
        // line 722
        echo ($context["help_order_status"] ?? null);
        echo "\">";
        echo ($context["entry_order_status"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_order_status_id\" id=\"input-order-status\" class=\"form-control\">
                      
                      ";
        // line 726
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 727
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 727) == ($context["config_order_status_id"] ?? null))) {
                // line 728
                echo "                      
                      <option value=\"";
                // line 729
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 729);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 729);
                echo "</option>
                      
                      ";
            } else {
                // line 732
                echo "                      
                      <option value=\"";
                // line 733
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 733);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 733);
                echo "</option>
                      
                      ";
            }
            // line 736
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 737
        echo "                    
                    </select>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-process-status\"><span data-toggle=\"tooltip\" title=\"";
        // line 742
        echo ($context["help_processing_status"] ?? null);
        echo "\">";
        echo ($context["entry_processing_status"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <div class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> ";
        // line 744
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 745
            echo "                      <div class=\"checkbox\">
                        <label> ";
            // line 746
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 746), ($context["config_processing_status"] ?? null))) {
                // line 747
                echo "                          <input type=\"checkbox\" name=\"config_processing_status[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 747);
                echo "\" checked=\"checked\" />
                          ";
                // line 748
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 748);
                echo "
                          ";
            } else {
                // line 750
                echo "                          <input type=\"checkbox\" name=\"config_processing_status[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 750);
                echo "\" />
                          ";
                // line 751
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 751);
                echo "
                          ";
            }
            // line 752
            echo " </label>
                      </div>
                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 754
        echo " </div>
                    ";
        // line 755
        if (($context["error_processing_status"] ?? null)) {
            // line 756
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_processing_status"] ?? null);
            echo "</div>
                    ";
        }
        // line 757
        echo " </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-complete-status\"><span data-toggle=\"tooltip\" title=\"";
        // line 760
        echo ($context["help_complete_status"] ?? null);
        echo "\">";
        echo ($context["entry_complete_status"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <div class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> ";
        // line 762
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 763
            echo "                      <div class=\"checkbox\">
                        <label> ";
            // line 764
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 764), ($context["config_complete_status"] ?? null))) {
                // line 765
                echo "                          <input type=\"checkbox\" name=\"config_complete_status[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 765);
                echo "\" checked=\"checked\" />
                          ";
                // line 766
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 766);
                echo "
                          ";
            } else {
                // line 768
                echo "                          <input type=\"checkbox\" name=\"config_complete_status[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 768);
                echo "\" />
                          ";
                // line 769
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 769);
                echo "
                          ";
            }
            // line 770
            echo " </label>
                      </div>
                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 772
        echo " </div>
                    ";
        // line 773
        if (($context["error_complete_status"] ?? null)) {
            // line 774
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_complete_status"] ?? null);
            echo "</div>
                    ";
        }
        // line 775
        echo " </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-fraud-status\"><span data-toggle=\"tooltip\" title=\"";
        // line 778
        echo ($context["help_fraud_status"] ?? null);
        echo "\">";
        echo ($context["entry_fraud_status"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_fraud_status_id\" id=\"input-fraud-status\" class=\"form-control\">
                      
                      ";
        // line 782
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 783
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 783) == ($context["config_fraud_status_id"] ?? null))) {
                // line 784
                echo "                      
                      <option value=\"";
                // line 785
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 785);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 785);
                echo "</option>
                      
                      ";
            } else {
                // line 788
                echo "                      
                      <option value=\"";
                // line 789
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 789);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 789);
                echo "</option>
                      
                      ";
            }
            // line 792
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 793
        echo "                    
                    </select>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-api\"><span data-toggle=\"tooltip\" title=\"";
        // line 798
        echo ($context["help_api"] ?? null);
        echo "\">";
        echo ($context["entry_api"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_api_id\" id=\"input-api\" class=\"form-control\">
                      <option value=\"0\">";
        // line 801
        echo ($context["text_none"] ?? null);
        echo "</option>
                      
                      ";
        // line 803
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["apis"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["api"]) {
            // line 804
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["api"], "api_id", [], "any", false, false, false, 804) == ($context["config_api_id"] ?? null))) {
                // line 805
                echo "                      
                      <option value=\"";
                // line 806
                echo twig_get_attribute($this->env, $this->source, $context["api"], "api_id", [], "any", false, false, false, 806);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["api"], "username", [], "any", false, false, false, 806);
                echo "</option>
                      
                      ";
            } else {
                // line 809
                echo "                      
                      <option value=\"";
                // line 810
                echo twig_get_attribute($this->env, $this->source, $context["api"], "api_id", [], "any", false, false, false, 810);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["api"], "username", [], "any", false, false, false, 810);
                echo "</option>
                      
                      ";
            }
            // line 813
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['api'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 814
        echo "                    
                    </select>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 820
        echo ($context["text_stock"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 822
        echo ($context["help_stock_display"] ?? null);
        echo "\">";
        echo ($context["entry_stock_display"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 824
        if (($context["config_stock_display"] ?? null)) {
            // line 825
            echo "                      <input type=\"radio\" name=\"config_stock_display\" value=\"1\" checked=\"checked\" />
                      ";
            // line 826
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 828
            echo "                      <input type=\"radio\" name=\"config_stock_display\" value=\"1\" />
                      ";
            // line 829
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 830
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 831
        if ( !($context["config_stock_display"] ?? null)) {
            // line 832
            echo "                      <input type=\"radio\" name=\"config_stock_display\" value=\"0\" checked=\"checked\" />
                      ";
            // line 833
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 835
            echo "                      <input type=\"radio\" name=\"config_stock_display\" value=\"0\" />
                      ";
            // line 836
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 837
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 841
        echo ($context["help_stock_warning"] ?? null);
        echo "\">";
        echo ($context["entry_stock_warning"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 843
        if (($context["config_stock_warning"] ?? null)) {
            // line 844
            echo "                      <input type=\"radio\" name=\"config_stock_warning\" value=\"1\" checked=\"checked\" />
                      ";
            // line 845
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 847
            echo "                      <input type=\"radio\" name=\"config_stock_warning\" value=\"1\" />
                      ";
            // line 848
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 849
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 850
        if ( !($context["config_stock_warning"] ?? null)) {
            // line 851
            echo "                      <input type=\"radio\" name=\"config_stock_warning\" value=\"0\" checked=\"checked\" />
                      ";
            // line 852
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 854
            echo "                      <input type=\"radio\" name=\"config_stock_warning\" value=\"0\" />
                      ";
            // line 855
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 856
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 860
        echo ($context["help_stock_checkout"] ?? null);
        echo "\">";
        echo ($context["entry_stock_checkout"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 862
        if (($context["config_stock_checkout"] ?? null)) {
            // line 863
            echo "                      <input type=\"radio\" name=\"config_stock_checkout\" value=\"1\" checked=\"checked\" />
                      ";
            // line 864
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 866
            echo "                      <input type=\"radio\" name=\"config_stock_checkout\" value=\"1\" />
                      ";
            // line 867
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 868
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 869
        if ( !($context["config_stock_checkout"] ?? null)) {
            // line 870
            echo "                      <input type=\"radio\" name=\"config_stock_checkout\" value=\"0\" checked=\"checked\" />
                      ";
            // line 871
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 873
            echo "                      <input type=\"radio\" name=\"config_stock_checkout\" value=\"0\" />
                      ";
            // line 874
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 875
        echo " </label>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 880
        echo ($context["text_affiliate"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-affiliate-group\">";
        // line 882
        echo ($context["entry_affiliate_group"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_affiliate_group_id\" id=\"input-affiliate-group\" class=\"form-control\">
                      
                      ";
        // line 886
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 887
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 887) == ($context["config_affiliate_group_id"] ?? null))) {
                // line 888
                echo "                      
                      <option value=\"";
                // line 889
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 889);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 889);
                echo "</option>
                      
                      ";
            } else {
                // line 892
                echo "                      
                      <option value=\"";
                // line 893
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 893);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 893);
                echo "</option>
                      
                      ";
            }
            // line 896
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 897
        echo "                    
                    </select>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 902
        echo ($context["help_affiliate_approval"] ?? null);
        echo "\">";
        echo ($context["entry_affiliate_approval"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 904
        if (($context["config_affiliate_approval"] ?? null)) {
            // line 905
            echo "                      <input type=\"radio\" name=\"config_affiliate_approval\" value=\"1\" checked=\"checked\" />
                      ";
            // line 906
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 908
            echo "                      <input type=\"radio\" name=\"config_affiliate_approval\" value=\"1\" />
                      ";
            // line 909
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 910
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 911
        if ( !($context["config_affiliate_approval"] ?? null)) {
            // line 912
            echo "                      <input type=\"radio\" name=\"config_affiliate_approval\" value=\"0\" checked=\"checked\" />
                      ";
            // line 913
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 915
            echo "                      <input type=\"radio\" name=\"config_affiliate_approval\" value=\"0\" />
                      ";
            // line 916
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 917
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 921
        echo ($context["help_affiliate_auto"] ?? null);
        echo "\">";
        echo ($context["entry_affiliate_auto"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 923
        if (($context["config_affiliate_auto"] ?? null)) {
            // line 924
            echo "                      <input type=\"radio\" name=\"config_affiliate_auto\" value=\"1\" checked=\"checked\" />
                      ";
            // line 925
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 927
            echo "                      <input type=\"radio\" name=\"config_affiliate_auto\" value=\"1\" />
                      ";
            // line 928
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 929
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 930
        if ( !($context["config_affiliate_auto"] ?? null)) {
            // line 931
            echo "                      <input type=\"radio\" name=\"config_affiliate_auto\" value=\"0\" checked=\"checked\" />
                      ";
            // line 932
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 934
            echo "                      <input type=\"radio\" name=\"config_affiliate_auto\" value=\"0\" />
                      ";
            // line 935
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 936
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-affiliate-commission\"><span data-toggle=\"tooltip\" title=\"";
        // line 940
        echo ($context["help_affiliate_commission"] ?? null);
        echo "\">";
        echo ($context["entry_affiliate_commission"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_affiliate_commission\" value=\"";
        // line 942
        echo ($context["config_affiliate_commission"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_affiliate_commission"] ?? null);
        echo "\" id=\"input-affiliate-commission\" class=\"form-control\" />
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-affiliate\"><span data-toggle=\"tooltip\" title=\"";
        // line 946
        echo ($context["help_affiliate"] ?? null);
        echo "\">";
        echo ($context["entry_affiliate"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_affiliate_id\" id=\"input-affiliate\" class=\"form-control\">
                      <option value=\"0\">";
        // line 949
        echo ($context["text_none"] ?? null);
        echo "</option>
                      
                      ";
        // line 951
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
            // line 952
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 952) == ($context["config_affiliate_id"] ?? null))) {
                // line 953
                echo "                      
                      <option value=\"";
                // line 954
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 954);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 954);
                echo "</option>
                      
                      ";
            } else {
                // line 957
                echo "                      
                      <option value=\"";
                // line 958
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 958);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 958);
                echo "</option>
                      
                      ";
            }
            // line 961
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 962
        echo "                    
                    </select>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 968
        echo ($context["text_return"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-return\"><span data-toggle=\"tooltip\" title=\"";
        // line 970
        echo ($context["help_return"] ?? null);
        echo "\">";
        echo ($context["entry_return"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_return_id\" id=\"input-return\" class=\"form-control\">
                      <option value=\"0\">";
        // line 973
        echo ($context["text_none"] ?? null);
        echo "</option>
                      
                      ";
        // line 975
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
            // line 976
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 976) == ($context["config_return_id"] ?? null))) {
                // line 977
                echo "                      
                      <option value=\"";
                // line 978
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 978);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 978);
                echo "</option>
                      
                      ";
            } else {
                // line 981
                echo "                      
                      <option value=\"";
                // line 982
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 982);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 982);
                echo "</option>
                      
                      ";
            }
            // line 985
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 986
        echo "                    
                    </select>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-return-status\"><span data-toggle=\"tooltip\" title=\"";
        // line 991
        echo ($context["help_return_status"] ?? null);
        echo "\">";
        echo ($context["entry_return_status"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_return_status_id\" id=\"input-return-status\" class=\"form-control\">
                      
                      ";
        // line 995
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["return_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["return_status"]) {
            // line 996
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["return_status"], "return_status_id", [], "any", false, false, false, 996) == ($context["config_return_status_id"] ?? null))) {
                // line 997
                echo "                      
                      <option value=\"";
                // line 998
                echo twig_get_attribute($this->env, $this->source, $context["return_status"], "return_status_id", [], "any", false, false, false, 998);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["return_status"], "name", [], "any", false, false, false, 998);
                echo "</option>
                      
                      ";
            } else {
                // line 1001
                echo "                      
                      <option value=\"";
                // line 1002
                echo twig_get_attribute($this->env, $this->source, $context["return_status"], "return_status_id", [], "any", false, false, false, 1002);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["return_status"], "name", [], "any", false, false, false, 1002);
                echo "</option>
                      
                      ";
            }
            // line 1005
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['return_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1006
        echo "                    
                    </select>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 1012
        echo ($context["text_captcha"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 1014
        echo ($context["help_captcha"] ?? null);
        echo "\">";
        echo ($context["entry_captcha"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_captcha\" id=\"input-captcha\" class=\"form-control\">
                      <option value=\"\">";
        // line 1017
        echo ($context["text_none"] ?? null);
        echo "</option>
                      
                      ";
        // line 1019
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["captchas"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["captcha"]) {
            // line 1020
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["captcha"], "value", [], "any", false, false, false, 1020) == ($context["config_captcha"] ?? null))) {
                // line 1021
                echo "                      
                      <option value=\"";
                // line 1022
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "value", [], "any", false, false, false, 1022);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "text", [], "any", false, false, false, 1022);
                echo "</option>
                      
                      ";
            } else {
                // line 1025
                echo "                      
                      <option value=\"";
                // line 1026
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "value", [], "any", false, false, false, 1026);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "text", [], "any", false, false, false, 1026);
                echo "</option>
                      
                      ";
            }
            // line 1029
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['captcha'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1030
        echo "                    
                    </select>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\">";
        // line 1035
        echo ($context["entry_captcha_page"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> ";
        // line 1037
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["captcha_pages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["captcha_page"]) {
            // line 1038
            echo "                      <div class=\"checkbox\">
                        <label> ";
            // line 1039
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["captcha_page"], "value", [], "any", false, false, false, 1039), ($context["config_captcha_page"] ?? null))) {
                // line 1040
                echo "                          <input type=\"checkbox\" name=\"config_captcha_page[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["captcha_page"], "value", [], "any", false, false, false, 1040);
                echo "\" checked=\"checked\" />
                          ";
                // line 1041
                echo twig_get_attribute($this->env, $this->source, $context["captcha_page"], "text", [], "any", false, false, false, 1041);
                echo "
                          ";
            } else {
                // line 1043
                echo "                          <input type=\"checkbox\" name=\"config_captcha_page[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["captcha_page"], "value", [], "any", false, false, false, 1043);
                echo "\" />
                          ";
                // line 1044
                echo twig_get_attribute($this->env, $this->source, $context["captcha_page"], "text", [], "any", false, false, false, 1044);
                echo "
                          ";
            }
            // line 1045
            echo " </label>
                      </div>
                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['captcha_page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1047
        echo " </div>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class=\"tab-pane\" id=\"tab-image\">
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-logo\">";
        // line 1054
        echo ($context["entry_logo"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\"><a href=\"\" id=\"thumb-logo\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 1055
        echo ($context["logo"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
                  <input type=\"hidden\" name=\"config_logo\" value=\"";
        // line 1056
        echo ($context["config_logo"] ?? null);
        echo "\" id=\"input-logo\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-icon\"><span data-toggle=\"tooltip\" title=\"";
        // line 1060
        echo ($context["help_icon"] ?? null);
        echo "\">";
        echo ($context["entry_icon"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\"><a href=\"\" id=\"thumb-icon\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 1061
        echo ($context["icon"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
                  <input type=\"hidden\" name=\"config_icon\" value=\"";
        // line 1062
        echo ($context["config_icon"] ?? null);
        echo "\" id=\"input-icon\" />
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-mail\">
              <fieldset>
                <legend>";
        // line 1068
        echo ($context["text_general"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-mail-engine\"><span data-toggle=\"tooltip\" title=\"";
        // line 1070
        echo ($context["help_mail_engine"] ?? null);
        echo "\">";
        echo ($context["entry_mail_engine"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <select name=\"config_mail_engine\" id=\"input-mail-engine\" class=\"form-control\">
                      
                      ";
        // line 1074
        if ((($context["config_mail_engine"] ?? null) == "mail")) {
            // line 1075
            echo "                      
                      <option value=\"mail\" selected=\"selected\">";
            // line 1076
            echo ($context["text_mail"] ?? null);
            echo "</option>
                      
                      ";
        } else {
            // line 1079
            echo "                      
                      <option value=\"mail\">";
            // line 1080
            echo ($context["text_mail"] ?? null);
            echo "</option>
                      
                      ";
        }
        // line 1083
        echo "                      ";
        if ((($context["config_mail_engine"] ?? null) == "smtp")) {
            // line 1084
            echo "                      
                      <option value=\"smtp\" selected=\"selected\">";
            // line 1085
            echo ($context["text_smtp"] ?? null);
            echo "</option>
                      
                      ";
        } else {
            // line 1088
            echo "                      
                      <option value=\"smtp\">";
            // line 1089
            echo ($context["text_smtp"] ?? null);
            echo "</option>
                      
                      ";
        }
        // line 1092
        echo "                    
                    </select>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-mail-parameter\"><span data-toggle=\"tooltip\" title=\"";
        // line 1097
        echo ($context["help_mail_parameter"] ?? null);
        echo "\">";
        echo ($context["entry_mail_parameter"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_parameter\" value=\"";
        // line 1099
        echo ($context["config_mail_parameter"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_parameter"] ?? null);
        echo "\" id=\"input-mail-parameter\" class=\"form-control\" />
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-mail-smtp-hostname\"><span data-toggle=\"tooltip\" title=\"";
        // line 1103
        echo ($context["help_mail_smtp_hostname"] ?? null);
        echo "\">";
        echo ($context["entry_mail_smtp_hostname"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_smtp_hostname\" value=\"";
        // line 1105
        echo ($context["config_mail_smtp_hostname"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_smtp_hostname"] ?? null);
        echo "\" id=\"input-mail-smtp-hostname\" class=\"form-control\" />
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-mail-smtp-username\">";
        // line 1109
        echo ($context["entry_mail_smtp_username"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_smtp_username\" value=\"";
        // line 1111
        echo ($context["config_mail_smtp_username"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_smtp_username"] ?? null);
        echo "\" id=\"input-mail-smtp-username\" class=\"form-control\" />
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-mail-smtp-password\"><span data-toggle=\"tooltip\" title=\"";
        // line 1115
        echo ($context["help_mail_smtp_password"] ?? null);
        echo "\">";
        echo ($context["entry_mail_smtp_password"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_smtp_password\" value=\"";
        // line 1117
        echo ($context["config_mail_smtp_password"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_smtp_password"] ?? null);
        echo "\" id=\"input-mail-smtp-password\" class=\"form-control\" />
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-mail-smtp-port\">";
        // line 1121
        echo ($context["entry_mail_smtp_port"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_smtp_port\" value=\"";
        // line 1123
        echo ($context["config_mail_smtp_port"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_smtp_port"] ?? null);
        echo "\" id=\"input-mail-smtp-port\" class=\"form-control\" />
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-mail-smtp-timeout\">";
        // line 1127
        echo ($context["entry_mail_smtp_timeout"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_mail_smtp_timeout\" value=\"";
        // line 1129
        echo ($context["config_mail_smtp_timeout"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mail_smtp_timeout"] ?? null);
        echo "\" id=\"input-mail-smtp-timeout\" class=\"form-control\" />
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 1134
        echo ($context["text_mail_alert"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 1136
        echo ($context["help_mail_alert"] ?? null);
        echo "\">";
        echo ($context["entry_mail_alert"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <div class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> ";
        // line 1138
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["mail_alerts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["mail_alert"]) {
            // line 1139
            echo "                      <div class=\"checkbox\">
                        <label> ";
            // line 1140
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["mail_alert"], "value", [], "any", false, false, false, 1140), ($context["config_mail_alert"] ?? null))) {
                // line 1141
                echo "                          <input type=\"checkbox\" name=\"config_mail_alert[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["mail_alert"], "value", [], "any", false, false, false, 1141);
                echo "\" checked=\"checked\" />
                          ";
                // line 1142
                echo twig_get_attribute($this->env, $this->source, $context["mail_alert"], "text", [], "any", false, false, false, 1142);
                echo "
                          ";
            } else {
                // line 1144
                echo "                          <input type=\"checkbox\" name=\"config_mail_alert[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["mail_alert"], "value", [], "any", false, false, false, 1144);
                echo "\" />
                          ";
                // line 1145
                echo twig_get_attribute($this->env, $this->source, $context["mail_alert"], "text", [], "any", false, false, false, 1145);
                echo "
                          ";
            }
            // line 1146
            echo " </label>
                      </div>
                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mail_alert'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1148
        echo " </div>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-mail-alert-email\"><span data-toggle=\"tooltip\" title=\"";
        // line 1152
        echo ($context["help_mail_alert_email"] ?? null);
        echo "\">";
        echo ($context["entry_mail_alert_email"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"config_mail_alert_email\" rows=\"5\" placeholder=\"";
        // line 1154
        echo ($context["entry_mail_alert_email"] ?? null);
        echo "\" id=\"input-alert-email\" class=\"form-control\">";
        echo ($context["config_mail_alert_email"] ?? null);
        echo "</textarea>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class=\"tab-pane\" id=\"tab-server\">
              <fieldset>
                <legend>";
        // line 1161
        echo ($context["text_general"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 1163
        echo ($context["help_maintenance"] ?? null);
        echo "\">";
        echo ($context["entry_maintenance"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 1165
        if (($context["config_maintenance"] ?? null)) {
            // line 1166
            echo "                      <input type=\"radio\" name=\"config_maintenance\" value=\"1\" checked=\"checked\" />
                      ";
            // line 1167
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 1169
            echo "                      <input type=\"radio\" name=\"config_maintenance\" value=\"1\" />
                      ";
            // line 1170
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 1171
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 1172
        if ( !($context["config_maintenance"] ?? null)) {
            // line 1173
            echo "                      <input type=\"radio\" name=\"config_maintenance\" value=\"0\" checked=\"checked\" />
                      ";
            // line 1174
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 1176
            echo "                      <input type=\"radio\" name=\"config_maintenance\" value=\"0\" />
                      ";
            // line 1177
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 1178
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 1182
        echo ($context["help_seo_url"] ?? null);
        echo "\">";
        echo ($context["entry_seo_url"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 1184
        if (($context["config_seo_url"] ?? null)) {
            // line 1185
            echo "                      <input type=\"radio\" name=\"config_seo_url\" value=\"1\" checked=\"checked\" />
                      ";
            // line 1186
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 1188
            echo "                      <input type=\"radio\" name=\"config_seo_url\" value=\"1\" />
                      ";
            // line 1189
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 1190
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 1191
        if ( !($context["config_seo_url"] ?? null)) {
            // line 1192
            echo "                      <input type=\"radio\" name=\"config_seo_url\" value=\"0\" checked=\"checked\" />
                      ";
            // line 1193
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 1195
            echo "                      <input type=\"radio\" name=\"config_seo_url\" value=\"0\" />
                      ";
            // line 1196
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 1197
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-robots\"><span data-toggle=\"tooltip\" title=\"";
        // line 1201
        echo ($context["help_robots"] ?? null);
        echo "\">";
        echo ($context["entry_robots"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"config_robots\" rows=\"5\" placeholder=\"";
        // line 1203
        echo ($context["entry_robots"] ?? null);
        echo "\" id=\"input-robots\" class=\"form-control\">";
        echo ($context["config_robots"] ?? null);
        echo "</textarea>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-compression\"><span data-toggle=\"tooltip\" title=\"";
        // line 1207
        echo ($context["help_compression"] ?? null);
        echo "\">";
        echo ($context["entry_compression"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_compression\" value=\"";
        // line 1209
        echo ($context["config_compression"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_compression"] ?? null);
        echo "\" id=\"input-compression\" class=\"form-control\" />
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 1214
        echo ($context["text_security"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 1216
        echo ($context["help_secure"] ?? null);
        echo "\">";
        echo ($context["entry_secure"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 1218
        if (($context["config_secure"] ?? null)) {
            // line 1219
            echo "                      <input type=\"radio\" name=\"config_secure\" value=\"1\" checked=\"checked\" />
                      ";
            // line 1220
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 1222
            echo "                      <input type=\"radio\" name=\"config_secure\" value=\"1\" />
                      ";
            // line 1223
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 1224
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 1225
        if ( !($context["config_secure"] ?? null)) {
            // line 1226
            echo "                      <input type=\"radio\" name=\"config_secure\" value=\"0\" checked=\"checked\" />
                      ";
            // line 1227
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 1229
            echo "                      <input type=\"radio\" name=\"config_secure\" value=\"0\" />
                      ";
            // line 1230
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 1231
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 1235
        echo ($context["help_password"] ?? null);
        echo "\">";
        echo ($context["entry_password"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 1237
        if (($context["config_password"] ?? null)) {
            // line 1238
            echo "                      <input type=\"radio\" name=\"config_password\" value=\"1\" checked=\"checked\" />
                      ";
            // line 1239
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 1241
            echo "                      <input type=\"radio\" name=\"config_password\" value=\"1\" />
                      ";
            // line 1242
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 1243
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 1244
        if ( !($context["config_password"] ?? null)) {
            // line 1245
            echo "                      <input type=\"radio\" name=\"config_password\" value=\"0\" checked=\"checked\" />
                      ";
            // line 1246
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 1248
            echo "                      <input type=\"radio\" name=\"config_password\" value=\"0\" />
                      ";
            // line 1249
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 1250
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 1254
        echo ($context["help_shared"] ?? null);
        echo "\">";
        echo ($context["entry_shared"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 1256
        if (($context["config_shared"] ?? null)) {
            // line 1257
            echo "                      <input type=\"radio\" name=\"config_shared\" value=\"1\" checked=\"checked\" />
                      ";
            // line 1258
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 1260
            echo "                      <input type=\"radio\" name=\"config_shared\" value=\"1\" />
                      ";
            // line 1261
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 1262
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 1263
        if ( !($context["config_shared"] ?? null)) {
            // line 1264
            echo "                      <input type=\"radio\" name=\"config_shared\" value=\"0\" checked=\"checked\" />
                      ";
            // line 1265
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 1267
            echo "                      <input type=\"radio\" name=\"config_shared\" value=\"0\" />
                      ";
            // line 1268
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 1269
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-encryption\"><span data-toggle=\"tooltip\" title=\"";
        // line 1273
        echo ($context["help_encryption"] ?? null);
        echo "\">";
        echo ($context["entry_encryption"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"config_encryption\" rows=\"5\" placeholder=\"";
        // line 1275
        echo ($context["entry_encryption"] ?? null);
        echo "\" id=\"input-encryption\" class=\"form-control\">";
        echo ($context["config_encryption"] ?? null);
        echo "</textarea>
                    ";
        // line 1276
        if (($context["error_encryption"] ?? null)) {
            // line 1277
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_encryption"] ?? null);
            echo "</div>
                    ";
        }
        // line 1278
        echo " </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 1282
        echo ($context["text_upload"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-file-max-size\"><span data-toggle=\"tooltip\" title=\"";
        // line 1284
        echo ($context["help_file_max_size"] ?? null);
        echo "\">";
        echo ($context["entry_file_max_size"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_file_max_size\" value=\"";
        // line 1286
        echo ($context["config_file_max_size"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_file_max_size"] ?? null);
        echo "\" id=\"input-file-max-size\" class=\"form-control\" />
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-file-ext-allowed\"><span data-toggle=\"tooltip\" title=\"";
        // line 1290
        echo ($context["help_file_ext_allowed"] ?? null);
        echo "\">";
        echo ($context["entry_file_ext_allowed"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"config_file_ext_allowed\" rows=\"5\" placeholder=\"";
        // line 1292
        echo ($context["entry_file_ext_allowed"] ?? null);
        echo "\" id=\"input-file-ext-allowed\" class=\"form-control\">";
        echo ($context["config_file_ext_allowed"] ?? null);
        echo "</textarea>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-file-mime-allowed\"><span data-toggle=\"tooltip\" title=\"";
        // line 1296
        echo ($context["help_file_mime_allowed"] ?? null);
        echo "\">";
        echo ($context["entry_file_mime_allowed"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"config_file_mime_allowed\" rows=\"5\" placeholder=\"";
        // line 1298
        echo ($context["entry_file_mime_allowed"] ?? null);
        echo "\" id=\"input-file-mime-allowed\" class=\"form-control\">";
        echo ($context["config_file_mime_allowed"] ?? null);
        echo "</textarea>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 1303
        echo ($context["text_error"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\">";
        // line 1305
        echo ($context["entry_error_display"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 1307
        if (($context["config_error_display"] ?? null)) {
            // line 1308
            echo "                      <input type=\"radio\" name=\"config_error_display\" value=\"1\" checked=\"checked\" />
                      ";
            // line 1309
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 1311
            echo "                      <input type=\"radio\" name=\"config_error_display\" value=\"1\" />
                      ";
            // line 1312
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 1313
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 1314
        if ( !($context["config_error_display"] ?? null)) {
            // line 1315
            echo "                      <input type=\"radio\" name=\"config_error_display\" value=\"0\" checked=\"checked\" />
                      ";
            // line 1316
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 1318
            echo "                      <input type=\"radio\" name=\"config_error_display\" value=\"0\" />
                      ";
            // line 1319
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 1320
        echo " </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\">";
        // line 1324
        echo ($context["entry_error_log"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\"> ";
        // line 1326
        if (($context["config_error_log"] ?? null)) {
            // line 1327
            echo "                      <input type=\"radio\" name=\"config_error_log\" value=\"1\" checked=\"checked\" />
                      ";
            // line 1328
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 1330
            echo "                      <input type=\"radio\" name=\"config_error_log\" value=\"1\" />
                      ";
            // line 1331
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 1332
        echo " </label>
                    <label class=\"radio-inline\"> ";
        // line 1333
        if ( !($context["config_error_log"] ?? null)) {
            // line 1334
            echo "                      <input type=\"radio\" name=\"config_error_log\" value=\"0\" checked=\"checked\" />
                      ";
            // line 1335
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 1337
            echo "                      <input type=\"radio\" name=\"config_error_log\" value=\"0\" />
                      ";
            // line 1338
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 1339
        echo "</label>
                  </div>
                </div>
                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-error-filename\">";
        // line 1343
        echo ($context["entry_error_filename"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"config_error_filename\" value=\"";
        // line 1345
        echo ($context["config_error_filename"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_error_filename"] ?? null);
        echo "\" id=\"input-error-filename\" class=\"form-control\" />
                    ";
        // line 1346
        if (($context["error_log"] ?? null)) {
            // line 1347
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_log"] ?? null);
            echo "</div>
                    ";
        }
        // line 1348
        echo " </div>
                </div>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type=\"text/javascript\"><!--
\$('select[name=\\'config_theme\\']').on('change', function() {
\t\$.ajax({
\t\turl: 'index.php?route=setting/setting/theme&user_token=";
        // line 1360
        echo ($context["user_token"] ?? null);
        echo "&theme=' + this.value,
\t\tdataType: 'html',
\t\tbeforeSend: function() {
\t\t\t\$('select[name=\\'config_theme\\']').prop('disabled', true);
\t\t},
\t\tcomplete: function() {
\t\t\t\$('select[name=\\'config_theme\\']').prop('disabled', false);
\t\t},
\t\tsuccess: function(html) {
\t\t\t\$('#theme').attr('src', html);
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('select[name=\\'config_theme\\']').trigger('change');
//--></script> 
  <script type=\"text/javascript\"><!--
\$('select[name=\\'config_country_id\\']').on('change', function() {
\t\$.ajax({
\t\turl: 'index.php?route=localisation/country/country&user_token=";
        // line 1382
        echo ($context["user_token"] ?? null);
        echo "&country_id=' + this.value,
\t\tdataType: 'json',
\t\tbeforeSend: function() {
\t\t\t\$('select[name=\\'config_country_id\\']').prop('disabled', true);
\t\t},
\t\tcomplete: function() {
\t\t\t\$('select[name=\\'config_country_id\\']').prop('disabled', false);
\t\t},
\t\tsuccess: function(json) {
\t\t\thtml = '<option value=\"\">";
        // line 1391
        echo ($context["text_select"] ?? null);
        echo "</option>';

\t\t\tif (json['zone'] && json['zone'] != '') {
\t\t\t\tfor (i = 0; i < json['zone'].length; i++) {
          \t\t\thtml += '<option value=\"' + json['zone'][i]['zone_id'] + '\"';

\t\t\t\t\tif (json['zone'][i]['zone_id'] == '";
        // line 1397
        echo ($context["config_zone_id"] ?? null);
        echo "') {
            \t\t\thtml += ' selected=\"selected\"';
\t\t\t\t\t}

\t\t\t\t\thtml += '>' + json['zone'][i]['name'] + '</option>';
\t\t\t\t}
\t\t\t} else {
\t\t\t\thtml += '<option value=\"0\" selected=\"selected\">";
        // line 1404
        echo ($context["text_none"] ?? null);
        echo "</option>';
\t\t\t}

\t\t\t\$('select[name=\\'config_zone_id\\']').html(html);
\t\t\t
\t\t\t\$('#button-save').prop('disabled', false);
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('select[name=\\'config_country_id\\']').trigger('change');
//--></script></div>
";
        // line 1419
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "setting/setting.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  3683 => 1419,  3665 => 1404,  3655 => 1397,  3646 => 1391,  3634 => 1382,  3609 => 1360,  3595 => 1348,  3589 => 1347,  3587 => 1346,  3581 => 1345,  3576 => 1343,  3570 => 1339,  3565 => 1338,  3562 => 1337,  3557 => 1335,  3554 => 1334,  3552 => 1333,  3549 => 1332,  3544 => 1331,  3541 => 1330,  3536 => 1328,  3533 => 1327,  3531 => 1326,  3526 => 1324,  3520 => 1320,  3515 => 1319,  3512 => 1318,  3507 => 1316,  3504 => 1315,  3502 => 1314,  3499 => 1313,  3494 => 1312,  3491 => 1311,  3486 => 1309,  3483 => 1308,  3481 => 1307,  3476 => 1305,  3471 => 1303,  3461 => 1298,  3454 => 1296,  3445 => 1292,  3438 => 1290,  3429 => 1286,  3422 => 1284,  3417 => 1282,  3411 => 1278,  3405 => 1277,  3403 => 1276,  3397 => 1275,  3390 => 1273,  3384 => 1269,  3379 => 1268,  3376 => 1267,  3371 => 1265,  3368 => 1264,  3366 => 1263,  3363 => 1262,  3358 => 1261,  3355 => 1260,  3350 => 1258,  3347 => 1257,  3345 => 1256,  3338 => 1254,  3332 => 1250,  3327 => 1249,  3324 => 1248,  3319 => 1246,  3316 => 1245,  3314 => 1244,  3311 => 1243,  3306 => 1242,  3303 => 1241,  3298 => 1239,  3295 => 1238,  3293 => 1237,  3286 => 1235,  3280 => 1231,  3275 => 1230,  3272 => 1229,  3267 => 1227,  3264 => 1226,  3262 => 1225,  3259 => 1224,  3254 => 1223,  3251 => 1222,  3246 => 1220,  3243 => 1219,  3241 => 1218,  3234 => 1216,  3229 => 1214,  3219 => 1209,  3212 => 1207,  3203 => 1203,  3196 => 1201,  3190 => 1197,  3185 => 1196,  3182 => 1195,  3177 => 1193,  3174 => 1192,  3172 => 1191,  3169 => 1190,  3164 => 1189,  3161 => 1188,  3156 => 1186,  3153 => 1185,  3151 => 1184,  3144 => 1182,  3138 => 1178,  3133 => 1177,  3130 => 1176,  3125 => 1174,  3122 => 1173,  3120 => 1172,  3117 => 1171,  3112 => 1170,  3109 => 1169,  3104 => 1167,  3101 => 1166,  3099 => 1165,  3092 => 1163,  3087 => 1161,  3075 => 1154,  3068 => 1152,  3062 => 1148,  3054 => 1146,  3049 => 1145,  3044 => 1144,  3039 => 1142,  3034 => 1141,  3032 => 1140,  3029 => 1139,  3025 => 1138,  3018 => 1136,  3013 => 1134,  3003 => 1129,  2998 => 1127,  2989 => 1123,  2984 => 1121,  2975 => 1117,  2968 => 1115,  2959 => 1111,  2954 => 1109,  2945 => 1105,  2938 => 1103,  2929 => 1099,  2922 => 1097,  2915 => 1092,  2909 => 1089,  2906 => 1088,  2900 => 1085,  2897 => 1084,  2894 => 1083,  2888 => 1080,  2885 => 1079,  2879 => 1076,  2876 => 1075,  2874 => 1074,  2865 => 1070,  2860 => 1068,  2851 => 1062,  2845 => 1061,  2839 => 1060,  2832 => 1056,  2826 => 1055,  2822 => 1054,  2813 => 1047,  2805 => 1045,  2800 => 1044,  2795 => 1043,  2790 => 1041,  2785 => 1040,  2783 => 1039,  2780 => 1038,  2776 => 1037,  2771 => 1035,  2764 => 1030,  2758 => 1029,  2750 => 1026,  2747 => 1025,  2739 => 1022,  2736 => 1021,  2733 => 1020,  2729 => 1019,  2724 => 1017,  2716 => 1014,  2711 => 1012,  2703 => 1006,  2697 => 1005,  2689 => 1002,  2686 => 1001,  2678 => 998,  2675 => 997,  2672 => 996,  2668 => 995,  2659 => 991,  2652 => 986,  2646 => 985,  2638 => 982,  2635 => 981,  2627 => 978,  2624 => 977,  2621 => 976,  2617 => 975,  2612 => 973,  2604 => 970,  2599 => 968,  2591 => 962,  2585 => 961,  2577 => 958,  2574 => 957,  2566 => 954,  2563 => 953,  2560 => 952,  2556 => 951,  2551 => 949,  2543 => 946,  2534 => 942,  2527 => 940,  2521 => 936,  2516 => 935,  2513 => 934,  2508 => 932,  2505 => 931,  2503 => 930,  2500 => 929,  2495 => 928,  2492 => 927,  2487 => 925,  2484 => 924,  2482 => 923,  2475 => 921,  2469 => 917,  2464 => 916,  2461 => 915,  2456 => 913,  2453 => 912,  2451 => 911,  2448 => 910,  2443 => 909,  2440 => 908,  2435 => 906,  2432 => 905,  2430 => 904,  2423 => 902,  2416 => 897,  2410 => 896,  2402 => 893,  2399 => 892,  2391 => 889,  2388 => 888,  2385 => 887,  2381 => 886,  2374 => 882,  2369 => 880,  2362 => 875,  2357 => 874,  2354 => 873,  2349 => 871,  2346 => 870,  2344 => 869,  2341 => 868,  2336 => 867,  2333 => 866,  2328 => 864,  2325 => 863,  2323 => 862,  2316 => 860,  2310 => 856,  2305 => 855,  2302 => 854,  2297 => 852,  2294 => 851,  2292 => 850,  2289 => 849,  2284 => 848,  2281 => 847,  2276 => 845,  2273 => 844,  2271 => 843,  2264 => 841,  2258 => 837,  2253 => 836,  2250 => 835,  2245 => 833,  2242 => 832,  2240 => 831,  2237 => 830,  2232 => 829,  2229 => 828,  2224 => 826,  2221 => 825,  2219 => 824,  2212 => 822,  2207 => 820,  2199 => 814,  2193 => 813,  2185 => 810,  2182 => 809,  2174 => 806,  2171 => 805,  2168 => 804,  2164 => 803,  2159 => 801,  2151 => 798,  2144 => 793,  2138 => 792,  2130 => 789,  2127 => 788,  2119 => 785,  2116 => 784,  2113 => 783,  2109 => 782,  2100 => 778,  2095 => 775,  2089 => 774,  2087 => 773,  2084 => 772,  2076 => 770,  2071 => 769,  2066 => 768,  2061 => 766,  2056 => 765,  2054 => 764,  2051 => 763,  2047 => 762,  2040 => 760,  2035 => 757,  2029 => 756,  2027 => 755,  2024 => 754,  2016 => 752,  2011 => 751,  2006 => 750,  2001 => 748,  1996 => 747,  1994 => 746,  1991 => 745,  1987 => 744,  1980 => 742,  1973 => 737,  1967 => 736,  1959 => 733,  1956 => 732,  1948 => 729,  1945 => 728,  1942 => 727,  1938 => 726,  1929 => 722,  1922 => 717,  1916 => 716,  1908 => 713,  1905 => 712,  1897 => 709,  1894 => 708,  1891 => 707,  1887 => 706,  1882 => 704,  1874 => 701,  1868 => 697,  1863 => 696,  1860 => 695,  1855 => 693,  1852 => 692,  1850 => 691,  1847 => 690,  1842 => 689,  1839 => 688,  1834 => 686,  1831 => 685,  1829 => 684,  1822 => 682,  1816 => 678,  1811 => 677,  1808 => 676,  1803 => 674,  1800 => 673,  1798 => 672,  1795 => 671,  1790 => 670,  1787 => 669,  1782 => 667,  1779 => 666,  1777 => 665,  1770 => 663,  1761 => 659,  1754 => 657,  1749 => 655,  1741 => 649,  1735 => 648,  1727 => 645,  1724 => 644,  1716 => 641,  1713 => 640,  1710 => 639,  1706 => 638,  1701 => 636,  1693 => 633,  1688 => 630,  1682 => 629,  1680 => 628,  1674 => 627,  1667 => 625,  1661 => 621,  1656 => 620,  1653 => 619,  1648 => 617,  1645 => 616,  1643 => 615,  1640 => 614,  1635 => 613,  1632 => 612,  1627 => 610,  1624 => 609,  1622 => 608,  1615 => 606,  1610 => 603,  1604 => 602,  1601 => 601,  1593 => 598,  1588 => 597,  1583 => 596,  1578 => 594,  1573 => 593,  1571 => 592,  1568 => 591,  1564 => 590,  1558 => 589,  1551 => 584,  1545 => 583,  1537 => 580,  1534 => 579,  1526 => 576,  1523 => 575,  1520 => 574,  1516 => 573,  1507 => 569,  1501 => 565,  1496 => 564,  1493 => 563,  1488 => 561,  1485 => 560,  1483 => 559,  1480 => 558,  1475 => 557,  1472 => 556,  1467 => 554,  1464 => 553,  1462 => 552,  1457 => 550,  1451 => 546,  1446 => 545,  1443 => 544,  1438 => 542,  1435 => 541,  1433 => 540,  1430 => 539,  1425 => 538,  1422 => 537,  1417 => 535,  1414 => 534,  1412 => 533,  1405 => 531,  1399 => 527,  1394 => 526,  1391 => 525,  1386 => 523,  1383 => 522,  1381 => 521,  1378 => 520,  1373 => 519,  1370 => 518,  1365 => 516,  1362 => 515,  1360 => 514,  1353 => 512,  1348 => 510,  1340 => 504,  1334 => 501,  1331 => 500,  1325 => 497,  1322 => 496,  1319 => 495,  1313 => 492,  1310 => 491,  1304 => 488,  1301 => 487,  1299 => 486,  1294 => 484,  1286 => 481,  1279 => 476,  1273 => 473,  1270 => 472,  1264 => 469,  1261 => 468,  1258 => 467,  1252 => 464,  1249 => 463,  1243 => 460,  1240 => 459,  1238 => 458,  1233 => 456,  1225 => 453,  1219 => 449,  1214 => 448,  1211 => 447,  1206 => 445,  1203 => 444,  1201 => 443,  1198 => 442,  1193 => 441,  1190 => 440,  1185 => 438,  1182 => 437,  1180 => 436,  1175 => 434,  1170 => 432,  1164 => 428,  1158 => 427,  1156 => 426,  1150 => 425,  1143 => 423,  1138 => 420,  1132 => 419,  1130 => 418,  1124 => 417,  1117 => 415,  1112 => 413,  1105 => 408,  1100 => 407,  1097 => 406,  1092 => 404,  1089 => 403,  1087 => 402,  1084 => 401,  1079 => 400,  1076 => 399,  1071 => 397,  1068 => 396,  1066 => 395,  1059 => 393,  1053 => 389,  1048 => 388,  1045 => 387,  1040 => 385,  1037 => 384,  1035 => 383,  1032 => 382,  1027 => 381,  1024 => 380,  1019 => 378,  1016 => 377,  1014 => 376,  1007 => 374,  1002 => 372,  996 => 368,  990 => 367,  988 => 366,  982 => 365,  975 => 363,  969 => 359,  964 => 358,  961 => 357,  956 => 355,  953 => 354,  951 => 353,  948 => 352,  943 => 351,  940 => 350,  935 => 348,  932 => 347,  930 => 346,  923 => 344,  918 => 342,  909 => 335,  903 => 334,  895 => 331,  892 => 330,  884 => 327,  881 => 326,  878 => 325,  874 => 324,  867 => 320,  860 => 315,  854 => 314,  846 => 311,  843 => 310,  835 => 307,  832 => 306,  829 => 305,  825 => 304,  818 => 300,  812 => 296,  807 => 295,  804 => 294,  799 => 292,  796 => 291,  794 => 290,  791 => 289,  786 => 288,  783 => 287,  778 => 285,  775 => 284,  773 => 283,  766 => 281,  759 => 276,  753 => 275,  745 => 272,  742 => 271,  734 => 268,  731 => 267,  728 => 266,  724 => 265,  715 => 261,  708 => 256,  702 => 255,  694 => 252,  691 => 251,  683 => 248,  680 => 247,  677 => 246,  673 => 245,  666 => 241,  659 => 236,  653 => 235,  645 => 232,  642 => 231,  634 => 228,  631 => 227,  628 => 226,  624 => 225,  617 => 221,  607 => 214,  600 => 209,  594 => 208,  586 => 205,  583 => 204,  575 => 201,  572 => 200,  569 => 199,  565 => 198,  558 => 194,  553 => 191,  548 => 189,  540 => 187,  535 => 186,  530 => 185,  525 => 183,  520 => 182,  518 => 181,  515 => 180,  511 => 179,  505 => 178,  502 => 177,  500 => 176,  492 => 173,  485 => 171,  476 => 167,  469 => 165,  462 => 161,  456 => 160,  452 => 159,  443 => 155,  438 => 153,  433 => 150,  427 => 149,  425 => 148,  419 => 147,  414 => 145,  409 => 142,  403 => 141,  401 => 140,  395 => 139,  390 => 137,  381 => 133,  374 => 131,  369 => 128,  363 => 127,  361 => 126,  355 => 125,  350 => 123,  345 => 120,  339 => 119,  337 => 118,  331 => 117,  326 => 115,  321 => 112,  315 => 111,  313 => 110,  307 => 109,  302 => 107,  293 => 100,  287 => 99,  279 => 96,  276 => 95,  268 => 92,  265 => 91,  262 => 90,  258 => 89,  251 => 85,  243 => 79,  237 => 78,  229 => 75,  226 => 74,  218 => 71,  215 => 70,  212 => 69,  208 => 68,  201 => 64,  192 => 60,  187 => 58,  178 => 54,  173 => 52,  168 => 49,  162 => 48,  160 => 47,  154 => 46,  149 => 44,  141 => 39,  137 => 38,  133 => 37,  129 => 36,  125 => 35,  121 => 34,  117 => 33,  112 => 31,  106 => 28,  102 => 26,  94 => 22,  91 => 21,  83 => 17,  81 => 16,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "setting/setting.twig", "");
    }
}
