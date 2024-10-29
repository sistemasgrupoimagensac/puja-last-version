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

/* invoiceNotaVenta.html.twig */
class __TwigTemplate_44230948b7175889d53752ab1fed520f extends Template
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
        yield "<html>
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    <style type=\"text/css\">
        ";
        // line 5
        yield from         $this->loadTemplate("assets/style.css", "invoiceNotaVenta.html.twig", 5)->unwrap()->yield($context);
        // line 6
        yield "        body {
            color: black !important;
        }
    </style>
</head>
<body class=\"white-bg\">
";
        // line 12
        $context["cp"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 12, $this->source); })()), "company", [], "any", false, false, false, 12);
        // line 13
        $context["isNota"] = CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 13, $this->source); })()), "tipoDoc", [], "any", false, false, false, 13), ["07", "08"]);
        // line 14
        $context["isAnticipo"] = (CoreExtension::getAttribute($this->env, $this->source, ($context["doc"] ?? null), "totalAnticipos", [], "any", true, true, false, 14) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 14, $this->source); })()), "totalAnticipos", [], "any", false, false, false, 14) > 0));
        // line 15
        $context["name"] = $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 15, $this->source); })()), "tipoDoc", [], "any", false, false, false, 15), "01");
        // line 16
        yield "<table width=\"100%\">
    <tbody><tr>
        <td style=\"padding:30px; !important\">
            <table width=\"100%\" height=\"200px\" border=\"0\" aling=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody><tr>
                    <td width=\"50%\" height=\"90\" align=\"center\">
                        <span><img src=\"";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\ImageFilter')->toBase64(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 22, $this->source); })()), "system", [], "any", false, false, false, 22), "logo", [], "any", false, false, false, 22)), "html", null, true);
        yield "\" height=\"80\" style=\"text-align:center\" border=\"0\"></span>
                    </td>
                    <td width=\"5%\" height=\"40\" align=\"center\"></td>
                    <td width=\"45%\" rowspan=\"2\" valign=\"bottom\" style=\"padding-left:0\">
                        <div class=\"tabla_borde\">
                            <table width=\"100%\" border=\"0\" height=\"200\" cellpadding=\"6\" cellspacing=\"0\">
                                <tbody><tr>
                                    <td align=\"center\">
                                        <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:29px\" text-align=\"center\">NOTA DE VENTA</span>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"center\">
                                        <span style=\"font-size:15px\" text-align=\"center\">R.U.C.: ";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cp"]) || array_key_exists("cp", $context) ? $context["cp"] : (function () { throw new RuntimeError('Variable "cp" does not exist.', 36, $this->source); })()), "ruc", [], "any", false, false, false, 36), "html", null, true);
        yield "</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"center\">
                                        <span style=\"font-size:24px\">";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 41, $this->source); })()), "serie", [], "any", false, false, false, 41), "html", null, true);
        yield "-";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 41, $this->source); })()), "correlativo", [], "any", false, false, false, 41), "html", null, true);
        yield "</span>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign=\"bottom\" style=\"padding-left:0\">
                        <div class=\"tabla_borde\">
                            <table width=\"96%\" height=\"100%\" border=\"0\" border-radius=\"\" cellpadding=\"9\" cellspacing=\"0\">
                                <tbody><tr>
                                    <td align=\"center\">
                                        <strong><span style=\"font-size:15px\">";
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cp"]) || array_key_exists("cp", $context) ? $context["cp"] : (function () { throw new RuntimeError('Variable "cp" does not exist.', 54, $this->source); })()), "razonSocial", [], "any", false, false, false, 54), "html", null, true);
        yield "</span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"left\">
                                        <strong>Dirección: </strong>";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["cp"]) || array_key_exists("cp", $context) ? $context["cp"] : (function () { throw new RuntimeError('Variable "cp" does not exist.', 59, $this->source); })()), "address", [], "any", false, false, false, 59), "direccion", [], "any", false, false, false, 59), "html", null, true);
        yield "
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"left\">
                                        ";
        // line 64
        yield CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 64, $this->source); })()), "user", [], "any", false, false, false, 64), "header", [], "any", false, false, false, 64);
        yield "
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </td>
                </tr>
                </tbody></table>
            <div class=\"tabla_borde\">
                ";
        // line 73
        $context["cl"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 73, $this->source); })()), "client", [], "any", false, false, false, 73);
        // line 74
        yield "                <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                    <tbody><tr>
                        <td width=\"60%\" align=\"left\"><strong>Razón Social:</strong>  ";
        // line 76
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 76, $this->source); })()), "rznSocial", [], "any", false, false, false, 76), "html", null, true);
        yield "</td>
                        <td width=\"40%\" align=\"left\"><strong>";
        // line 77
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 77, $this->source); })()), "tipoDoc", [], "any", false, false, false, 77), "06"), "html", null, true);
        yield ":</strong>  ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 77, $this->source); })()), "numDoc", [], "any", false, false, false, 77), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <td width=\"60%\" align=\"left\">
                            <strong>Fecha Emisión: </strong>  ";
        // line 81
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 81, $this->source); })()), "fechaEmision", [], "any", false, false, false, 81), "d/m/Y"), "html", null, true);
        yield "
                            ";
        // line 82
        if (($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 82, $this->source); })()), "fechaEmision", [], "any", false, false, false, 82), "H:i:s") != "00:00:00")) {
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 82, $this->source); })()), "fechaEmision", [], "any", false, false, false, 82), "H:i:s"), "html", null, true);
            yield " ";
        }
        // line 83
        yield "                            ";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["doc"] ?? null), "fecVencimiento", [], "any", true, true, false, 83) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 83, $this->source); })()), "fecVencimiento", [], "any", false, false, false, 83))) {
            // line 84
            yield "                            <br><br><strong>Fecha Vencimiento: </strong>  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 84, $this->source); })()), "fecVencimiento", [], "any", false, false, false, 84), "d/m/Y"), "html", null, true);
            yield "
                            ";
        }
        // line 86
        yield "                        </td>
                        <td width=\"40%\" align=\"left\"><strong>Dirección: </strong>  ";
        // line 87
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 87, $this->source); })()), "address", [], "any", false, false, false, 87)) {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 87, $this->source); })()), "address", [], "any", false, false, false, 87), "direccion", [], "any", false, false, false, 87), "html", null, true);
        }
        yield "</td>
                    </tr>
                    ";
        // line 89
        if ((isset($context["isNota"]) || array_key_exists("isNota", $context) ? $context["isNota"] : (function () { throw new RuntimeError('Variable "isNota" does not exist.', 89, $this->source); })())) {
            // line 90
            yield "                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Tipo Doc. Ref.: </strong>  ";
            // line 91
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 91, $this->source); })()), "tipDocAfectado", [], "any", false, false, false, 91), "01"), "html", null, true);
            yield "</td>
                        <td width=\"40%\" align=\"left\"><strong>Documento Ref.: </strong>  ";
            // line 92
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 92, $this->source); })()), "numDocfectado", [], "any", false, false, false, 92), "html", null, true);
            yield "</td>
                    </tr>
                    ";
        }
        // line 95
        yield "                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Tipo Moneda: </strong>  ";
        // line 96
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 96, $this->source); })()), "tipoMoneda", [], "any", false, false, false, 96), "021"), "html", null, true);
        yield " </td>
                        <td width=\"40%\" align=\"left\">";
        // line 97
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["doc"] ?? null), "compra", [], "any", true, true, false, 97) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 97, $this->source); })()), "compra", [], "any", false, false, false, 97))) {
            yield "<strong>O/C: </strong>  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 97, $this->source); })()), "compra", [], "any", false, false, false, 97), "html", null, true);
        }
        yield "</td>
                    </tr>
                    ";
        // line 99
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 99, $this->source); })()), "guias", [], "any", false, false, false, 99)) {
            // line 100
            yield "                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Guias: </strong>
                        ";
            // line 102
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 102, $this->source); })()), "guias", [], "any", false, false, false, 102));
            foreach ($context['_seq'] as $context["_key"] => $context["guia"]) {
                // line 103
                yield "                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["guia"], "nroDoc", [], "any", false, false, false, 103), "html", null, true);
                yield "&nbsp;&nbsp;
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['guia'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 104
            yield "</td>
                        <td width=\"40%\"></td>
                    </tr>
                    ";
        }
        // line 108
        yield "                    </tbody></table>
            </div><br>
            ";
        // line 110
        $context["moneda"] = $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 110, $this->source); })()), "tipoMoneda", [], "any", false, false, false, 110), "02");
        // line 111
        yield "            <div class=\"tabla_borde\">
                <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                    <tbody>
                        <tr>
                            <td align=\"center\" class=\"bold\">Cantidad</td>
                            <td align=\"center\" class=\"bold\">Código</td>
                            <td align=\"center\" class=\"bold\">Descripción</td>
                            <td align=\"center\" class=\"bold\">Valor Unitario</td>
                            <td align=\"center\" class=\"bold\">Valor Total</td>
                        </tr>
                        ";
        // line 121
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 121, $this->source); })()), "details", [], "any", false, false, false, 121));
        foreach ($context['_seq'] as $context["_key"] => $context["det"]) {
            // line 122
            yield "                        <tr class=\"border_top\">
                            <td align=\"center\">
                                ";
            // line 124
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "cantidad", [], "any", false, false, false, 124), 0, "."), "html", null, true);
            yield "
                                ";
            // line 125
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["det"], "unidad", [], "any", false, false, false, 125) == "NIU")) {
                yield " UND ";
            }
            // line 126
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["det"], "unidad", [], "any", false, false, false, 126) != "NIU")) {
                yield "   ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "unidad", [], "any", false, false, false, 126), "html", null, true);
                yield " ";
            }
            // line 127
            yield "                            </td>
                            <td align=\"center\">
                                ";
            // line 129
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "codProducto", [], "any", false, false, false, 129), "html", null, true);
            yield "
                            </td>
                            <td align=\"center\" width=\"300px\">
                                <span>";
            // line 132
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "descripcion", [], "any", false, false, false, 132), "html", null, true);
            yield "</span><br>
                            </td>
                            <td align=\"center\">
                                ";
            // line 135
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 135, $this->source); })()), "html", null, true);
            yield "
                                ";
            // line 136
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "mtoValorUnitario", [], "any", false, false, false, 136)), "html", null, true);
            yield "
                            </td>
                            <td align=\"center\">
                                ";
            // line 139
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 139, $this->source); })()), "html", null, true);
            yield "
                                ";
            // line 140
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "mtoValorVenta", [], "any", false, false, false, 140)), "html", null, true);
            yield "
                            </td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['det'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 144
        yield "                    </tbody>
                </table></div>
            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody><tr>
                    <td width=\"50%\" valign=\"top\">
                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                            <tbody>
                            <tr>
                                <td colspan=\"4\">
                                    <br>
                                    <br>
                                    <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:12px\" text-align=\"center\"><strong>";
        // line 155
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\ResolveFilter')->getValueLegend(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 155, $this->source); })()), "legends", [], "any", false, false, false, 155), "1000"), "html", null, true);
        yield "</strong></span>
                                    <br>
                                    <br>
                                    <strong>Información Adicional</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                            <tbody>
                            ";
        // line 165
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 165, $this->source); })()), "observacion", [], "any", false, false, false, 165)) {
            // line 166
            yield "                                <tr class=\"border_top\">
                                    <td width=\"70%\" style=\"font-size: 12px;\">
                                        <br><br>
                                        <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:12px\" text-align=\"center\">OBSERVACIONES: </span>
                                        <br>
                                        <p>";
            // line 171
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 171, $this->source); })()), "observacion", [], "any", false, false, false, 171), "html", null, true);
            yield "</p>
                                    </td>
                                </tr>
                            ";
        }
        // line 175
        yield "                            <tr class=\"border_top\">
                                <td width=\"30%\" style=\"font-size: 10px;\">
                                    LEYENDA:
                                </td>
                                <td width=\"70%\" style=\"font-size: 10px;\">
                                    <p>
                                        ";
        // line 181
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 181, $this->source); })()), "legends", [], "any", false, false, false, 181));
        foreach ($context['_seq'] as $context["_key"] => $context["leg"]) {
            // line 182
            yield "                                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["leg"], "code", [], "any", false, false, false, 182) != "1000")) {
                // line 183
                yield "                                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["leg"], "value", [], "any", false, false, false, 183), "html", null, true);
                yield "<br>
                                        ";
            }
            // line 185
            yield "                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['leg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 186
        yield "                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width=\"50%\" valign=\"top\">
                        <br>
                        <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-valores-totales\">
                            <tbody>
                            ";
        // line 196
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 196, $this->source); })()), "mtoOperExoneradas", [], "any", false, false, false, 196)) {
            // line 197
            yield "                            <tr class=\"border_bottom\">
                                <td align=\"right\"><strong>Total:</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
            // line 199
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 199, $this->source); })()), "html", null, true);
            yield "  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 199, $this->source); })()), "mtoOperExoneradas", [], "any", false, false, false, 199)), "html", null, true);
            yield "</span></td>
                            </tr>
                            ";
        }
        // line 202
        yield "                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody></table>
            <br>
            <br>
            ";
        // line 209
        if ((array_key_exists("max_items", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 209, $this->source); })()), "details", [], "any", false, false, false, 209)) > (isset($context["max_items"]) || array_key_exists("max_items", $context) ? $context["max_items"] : (function () { throw new RuntimeError('Variable "max_items" does not exist.', 209, $this->source); })())))) {
            // line 210
            yield "                <div style=\"page-break-after:always;\"></div>
            ";
        }
        // line 212
        yield "            <div>
                <hr style=\"display: block; height: 1px; border: 0; border-top: 1px solid #666; margin: 20px 0; padding: 0;\"><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                    <tbody><tr>
                        <td width=\"85%\">
                            <blockquote>
                                ";
        // line 217
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "user", [], "any", false, true, false, 217), "footer", [], "any", true, true, false, 217)) {
            // line 218
            yield "                                    ";
            yield CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 218, $this->source); })()), "user", [], "any", false, false, false, 218), "footer", [], "any", false, false, false, 218);
            yield "
                                ";
        }
        // line 220
        yield "                                ";
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "system", [], "any", false, true, false, 220), "hash", [], "any", true, true, false, 220) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 220, $this->source); })()), "system", [], "any", false, false, false, 220), "hash", [], "any", false, false, false, 220))) {
            // line 221
            yield "                                    <strong>Resumen:</strong>   ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 221, $this->source); })()), "system", [], "any", false, false, false, 221), "hash", [], "any", false, false, false, 221), "html", null, true);
            yield "<br>
                                ";
        }
        // line 223
        yield "                                <span>Representación Impresa de la NOTA DE VENTA ELECTRÓNICA.</span>
                                <!--<span>Este documento no es un comprobante de pago, si desea uno intercambialo por una BOLETA o FACTURA</span>-->
                            </blockquote>
                        </td>
                    </tr>
                    <tr>
                        <td class=\"bold\">
                          ";
        // line 230
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "user", [], "any", false, true, false, 230), "mensajeImpresion", [], "any", true, true, false, 230)) {
            // line 231
            yield "                           <center>  ";
            yield CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 231, $this->source); })()), "user", [], "any", false, false, false, 231), "mensajeImpresion", [], "any", false, false, false, 231);
            yield " </center>
                          ";
        }
        // line 233
        yield "                        </td>
                    </tr>
                    </tbody></table>
            </div>
        </td>
    </tr>
    </tbody></table>
</body></html>";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "invoiceNotaVenta.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  476 => 233,  470 => 231,  468 => 230,  459 => 223,  453 => 221,  450 => 220,  444 => 218,  442 => 217,  435 => 212,  431 => 210,  429 => 209,  420 => 202,  412 => 199,  408 => 197,  406 => 196,  394 => 186,  388 => 185,  382 => 183,  379 => 182,  375 => 181,  367 => 175,  360 => 171,  353 => 166,  351 => 165,  338 => 155,  325 => 144,  315 => 140,  311 => 139,  305 => 136,  301 => 135,  295 => 132,  289 => 129,  285 => 127,  278 => 126,  274 => 125,  270 => 124,  266 => 122,  262 => 121,  250 => 111,  248 => 110,  244 => 108,  238 => 104,  229 => 103,  225 => 102,  221 => 100,  219 => 99,  211 => 97,  207 => 96,  204 => 95,  198 => 92,  194 => 91,  191 => 90,  189 => 89,  182 => 87,  179 => 86,  173 => 84,  170 => 83,  164 => 82,  160 => 81,  151 => 77,  147 => 76,  143 => 74,  141 => 73,  129 => 64,  121 => 59,  113 => 54,  95 => 41,  87 => 36,  70 => 22,  62 => 16,  60 => 15,  58 => 14,  56 => 13,  54 => 12,  46 => 6,  44 => 5,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "invoiceNotaVenta.html.twig", "C:\\xampp\\htdocs\\puja-last-version\\app\\templates\\invoiceNotaVenta.html.twig");
    }
}
