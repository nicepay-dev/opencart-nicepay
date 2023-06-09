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

/* default/template/extension/payment/nicepay_va.twig */
class __TwigTemplate_f588e445d1cc4b355c94d9c28244072026aa8b3556a65a8718991ad9e5b1bf6c extends \Twig\Template
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
        echo "<form action=\"";
        echo ($context["action"] ?? null);
        echo "\" method=\"post\">
  <select name=\"bankCd\" class=\"form-control\">
      <option value=\"\">Choose Bank:</option>
      <option value=\"BMRI\">Bank Mandiri</option>
      <option value=\"IBBK\">Bank International Indonesia Maybank</option>
      <option value=\"BBBA\">Bank Permata</option>
      <option value=\"CENA\">Bank Central Asia</option>
      <option value=\"BNIN\">Bank Negara Indonesia 46</option>
      <option value=\"HNBN\">Bank KEB Hana Indonesia</option>
      <option value=\"BRIN\">Bank Rakyat Indonesia</option>
      <option value=\"BNIA\">Bank PT. BANK CIMB NIAGA, TBK.</option>
      <option value=\"BDIN\">Bank PT. BANK DANAMON INDONESIA, TBK</option>
  </select>
  <div class=\"buttons\">
    <div class=\"pull-right\">
      <input type=\"submit\" value=\"";
        // line 16
        echo ($context["button_confirm"] ?? null);
        echo "\" class=\"btn btn-primary\" />
    </div>
  </div>
</form>";
    }

    public function getTemplateName()
    {
        return "default/template/extension/payment/nicepay_va.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 16,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/extension/payment/nicepay_va.twig", "");
    }
}
