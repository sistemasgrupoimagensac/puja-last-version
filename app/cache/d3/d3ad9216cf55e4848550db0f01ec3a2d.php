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

/* invoice.html.twig */
class __TwigTemplate_7605e3da65618740d59ace927eed0953 extends Template
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
        yield from         $this->loadTemplate("assets/style.css", "invoice.html.twig", 5)->unwrap()->yield($context);
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
                                        <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:29px\" text-align=\"center\">";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 30, $this->source); })()), "html", null, true);
        yield "</span>
                                        <br>
                                        <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:19px\" text-align=\"center\">E L E C T R Ó N I C A</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"center\">
                                        <span style=\"font-size:15px\" text-align=\"center\">R.U.C.: ";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cp"]) || array_key_exists("cp", $context) ? $context["cp"] : (function () { throw new RuntimeError('Variable "cp" does not exist.', 37, $this->source); })()), "ruc", [], "any", false, false, false, 37), "html", null, true);
        yield "</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"center\">
                                        <span style=\"font-size:24px\">";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 42, $this->source); })()), "serie", [], "any", false, false, false, 42), "html", null, true);
        yield "-";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 42, $this->source); })()), "correlativo", [], "any", false, false, false, 42), "html", null, true);
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
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cp"]) || array_key_exists("cp", $context) ? $context["cp"] : (function () { throw new RuntimeError('Variable "cp" does not exist.', 55, $this->source); })()), "razonSocial", [], "any", false, false, false, 55), "html", null, true);
        yield "</span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"left\">
                                        <strong>Dirección: </strong>";
        // line 60
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["cp"]) || array_key_exists("cp", $context) ? $context["cp"] : (function () { throw new RuntimeError('Variable "cp" does not exist.', 60, $this->source); })()), "address", [], "any", false, false, false, 60), "direccion", [], "any", false, false, false, 60), "html", null, true);
        yield "
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"left\">
                                        ";
        // line 65
        yield CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 65, $this->source); })()), "user", [], "any", false, false, false, 65), "header", [], "any", false, false, false, 65);
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
        // line 74
        $context["cl"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 74, $this->source); })()), "client", [], "any", false, false, false, 74);
        // line 75
        yield "                <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                    <tbody><tr>
                        <td width=\"60%\" align=\"left\"><strong>Razón Social:</strong>  ";
        // line 77
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 77, $this->source); })()), "rznSocial", [], "any", false, false, false, 77), "html", null, true);
        yield "</td>
                        <td width=\"40%\" align=\"left\"><strong>";
        // line 78
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 78, $this->source); })()), "tipoDoc", [], "any", false, false, false, 78), "06"), "html", null, true);
        yield ":</strong>  ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 78, $this->source); })()), "numDoc", [], "any", false, false, false, 78), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <td width=\"60%\" align=\"left\">
                            <strong>Fecha Emisión: </strong>  ";
        // line 82
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 82, $this->source); })()), "fechaEmision", [], "any", false, false, false, 82), "d/m/Y"), "html", null, true);
        yield "
                            ";
        // line 83
        if (($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 83, $this->source); })()), "fechaEmision", [], "any", false, false, false, 83), "H:i:s") != "00:00:00")) {
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 83, $this->source); })()), "fechaEmision", [], "any", false, false, false, 83), "H:i:s"), "html", null, true);
            yield " ";
        }
        // line 84
        yield "                            ";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["doc"] ?? null), "fecVencimiento", [], "any", true, true, false, 84) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 84, $this->source); })()), "fecVencimiento", [], "any", false, false, false, 84))) {
            // line 85
            yield "                            <br><br><strong>Fecha Vencimiento: </strong>  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 85, $this->source); })()), "fecVencimiento", [], "any", false, false, false, 85), "d/m/Y"), "html", null, true);
            yield "
                            ";
        }
        // line 87
        yield "                        </td>
                        <td width=\"40%\" align=\"left\"><strong>Dirección: </strong>  ";
        // line 88
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 88, $this->source); })()), "address", [], "any", false, false, false, 88)) {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 88, $this->source); })()), "address", [], "any", false, false, false, 88), "direccion", [], "any", false, false, false, 88), "html", null, true);
        }
        yield "</td>
                    </tr>
                    ";
        // line 90
        if ((isset($context["isNota"]) || array_key_exists("isNota", $context) ? $context["isNota"] : (function () { throw new RuntimeError('Variable "isNota" does not exist.', 90, $this->source); })())) {
            // line 91
            yield "                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Tipo Doc. Ref.: </strong>  ";
            // line 92
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 92, $this->source); })()), "tipDocAfectado", [], "any", false, false, false, 92), "01"), "html", null, true);
            yield "</td>
                        <td width=\"40%\" align=\"left\"><strong>Documento Ref.: </strong>  ";
            // line 93
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 93, $this->source); })()), "numDocfectado", [], "any", false, false, false, 93), "html", null, true);
            yield "</td>
                    </tr>
                    ";
        }
        // line 96
        yield "                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Tipo Moneda: </strong>  ";
        // line 97
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 97, $this->source); })()), "tipoMoneda", [], "any", false, false, false, 97), "021"), "html", null, true);
        yield " </td>
                        <td width=\"40%\" align=\"left\">";
        // line 98
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["doc"] ?? null), "compra", [], "any", true, true, false, 98) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 98, $this->source); })()), "compra", [], "any", false, false, false, 98))) {
            yield "<strong>O/C: </strong>  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 98, $this->source); })()), "compra", [], "any", false, false, false, 98), "html", null, true);
        }
        yield "</td>
                    </tr>
                    ";
        // line 100
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 100, $this->source); })()), "guias", [], "any", false, false, false, 100)) {
            // line 101
            yield "                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Guias: </strong>
                        ";
            // line 103
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 103, $this->source); })()), "guias", [], "any", false, false, false, 103));
            foreach ($context['_seq'] as $context["_key"] => $context["guia"]) {
                // line 104
                yield "                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["guia"], "nroDoc", [], "any", false, false, false, 104), "html", null, true);
                yield "&nbsp;&nbsp;
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['guia'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 105
            yield "</td>
                        <td width=\"40%\"></td>
                    </tr>
                    ";
        }
        // line 109
        yield "                    </tbody></table>
            </div><br>
            ";
        // line 111
        $context["moneda"] = $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 111, $this->source); })()), "tipoMoneda", [], "any", false, false, false, 111), "02");
        // line 112
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
        // line 122
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 122, $this->source); })()), "details", [], "any", false, false, false, 122));
        foreach ($context['_seq'] as $context["_key"] => $context["det"]) {
            // line 123
            yield "                        <tr class=\"border_top\">
                            <td align=\"center\">
                                ";
            // line 125
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "cantidad", [], "any", false, false, false, 125), 0, "."), "html", null, true);
            yield "
                                ";
            // line 126
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["det"], "unidad", [], "any", false, false, false, 126) == "NIU")) {
                yield " UND ";
            }
            // line 127
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["det"], "unidad", [], "any", false, false, false, 127) != "NIU")) {
                yield "   ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "unidad", [], "any", false, false, false, 127), "html", null, true);
                yield " ";
            }
            // line 128
            yield "                            </td>
                            <td align=\"center\">
                                ";
            // line 130
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "codProducto", [], "any", false, false, false, 130), "html", null, true);
            yield "
                            </td>
                            <td align=\"center\" width=\"300px\">
                                <span>";
            // line 133
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "descripcion", [], "any", false, false, false, 133), "html", null, true);
            yield "</span><br>
                            </td>
                            <td align=\"center\">
                                ";
            // line 136
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 136, $this->source); })()), "html", null, true);
            yield "
                                ";
            // line 137
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "mtoValorUnitario", [], "any", false, false, false, 137)), "html", null, true);
            yield "
                            </td>
                            <td align=\"center\">
                                ";
            // line 140
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 140, $this->source); })()), "html", null, true);
            yield "
                                ";
            // line 141
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, $context["det"], "mtoValorVenta", [], "any", false, false, false, 141)), "html", null, true);
            yield "
                            </td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['det'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 145
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
        // line 156
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\ResolveFilter')->getValueLegend(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 156, $this->source); })()), "legends", [], "any", false, false, false, 156), "1000"), "html", null, true);
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
        // line 166
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 166, $this->source); })()), "observacion", [], "any", false, false, false, 166)) {
            // line 167
            yield "                                <tr class=\"border_top\">
                                    <td width=\"70%\" style=\"font-size: 12px;\">
                                        <br><br>
                                        <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:12px\" text-align=\"center\">OBSERVACIONES: </span>
                                        <br>
                                        <p>";
            // line 172
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 172, $this->source); })()), "observacion", [], "any", false, false, false, 172), "html", null, true);
            yield "</p>
                                    </td>
                                </tr>
                            ";
        }
        // line 176
        yield "                            <tr class=\"border_top\">
                                <td width=\"30%\" style=\"font-size: 10px;\">
                                    LEYENDA:
                                </td>
                                <td width=\"70%\" style=\"font-size: 10px;\">
                                    <p>
                                        ";
        // line 182
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 182, $this->source); })()), "legends", [], "any", false, false, false, 182));
        foreach ($context['_seq'] as $context["_key"] => $context["leg"]) {
            // line 183
            yield "                                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["leg"], "code", [], "any", false, false, false, 183) != "1000")) {
                // line 184
                yield "                                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["leg"], "value", [], "any", false, false, false, 184), "html", null, true);
                yield "<br>
                                        ";
            }
            // line 186
            yield "                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['leg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 187
        yield "                                    </p>
                                </td>
                            </tr>
                            ";
        // line 190
        if ((isset($context["isNota"]) || array_key_exists("isNota", $context) ? $context["isNota"] : (function () { throw new RuntimeError('Variable "isNota" does not exist.', 190, $this->source); })())) {
            // line 191
            yield "                            <tr class=\"border_top\">
                                <td width=\"30%\" style=\"font-size: 10px;\">
                                    MOTIVO DE EMISIÓN:
                                </td>
                                <td width=\"70%\" style=\"font-size: 10px;\">
                                    ";
            // line 196
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 196, $this->source); })()), "desMotivo", [], "any", false, false, false, 196), "html", null, true);
            yield "
                                </td>
                            </tr>
                            ";
        }
        // line 200
        yield "                            ";
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "user", [], "any", false, true, false, 200), "extras", [], "any", true, true, false, 200)) {
            // line 201
            yield "                                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 201, $this->source); })()), "user", [], "any", false, false, false, 201), "extras", [], "any", false, false, false, 201));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 202
                yield "                                    <tr class=\"border_top\">
                                        <td width=\"30%\" style=\"font-size: 10px;\">
                                            ";
                // line 204
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 204)), "html", null, true);
                yield ":
                                        </td>
                                        <td width=\"70%\" style=\"font-size: 10px;\">
                                            ";
                // line 207
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "value", [], "any", false, false, false, 207), "html", null, true);
                yield "
                                        </td>
                                    </tr>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 211
            yield "                            ";
        }
        // line 212
        yield "                            </tbody>
                        </table>
                        ";
        // line 214
        if ((isset($context["isAnticipo"]) || array_key_exists("isAnticipo", $context) ? $context["isAnticipo"] : (function () { throw new RuntimeError('Variable "isAnticipo" does not exist.', 214, $this->source); })())) {
            // line 215
            yield "                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                            <tbody>
                            <tr>
                                <td>
                                    <br>
                                    <strong>Anticipo</strong>
                                    <br>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\" style=\"font-size: 10px;\">
                            <tbody>
                            <tr>
                                <td width=\"30%\"><b>Nro. Doc.</b></td>
                                <td width=\"70%\"><b>Total</b></td>
                            </tr>
                            ";
            // line 232
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 232, $this->source); })()), "anticipos", [], "any", false, false, false, 232));
            foreach ($context['_seq'] as $context["_key"] => $context["atp"]) {
                // line 233
                yield "                            <tr class=\"border_top\">
                                <td width=\"30%\">";
                // line 234
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["atp"], "nroDocRel", [], "any", false, false, false, 234), "html", null, true);
                yield "</td>
                                <td width=\"70%\">";
                // line 235
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 235, $this->source); })()), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, $context["atp"], "total", [], "any", false, false, false, 235)), "html", null, true);
                yield "</td>
                            </tr>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atp'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 238
            yield "                            </tbody>
                        </table>
                        ";
        }
        // line 241
        yield "                    </td>
                    <td width=\"50%\" valign=\"top\">
                        <br>
                        <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-valores-totales\">
                            <tbody>
                            ";
        // line 246
        if ((isset($context["isAnticipo"]) || array_key_exists("isAnticipo", $context) ? $context["isAnticipo"] : (function () { throw new RuntimeError('Variable "isAnticipo" does not exist.', 246, $this->source); })())) {
            // line 247
            yield "                                <tr class=\"border_bottom\">
                                    <td align=\"right\"><strong>Total Anticipo:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 249
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 249, $this->source); })()), "html", null, true);
            yield "  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 249, $this->source); })()), "totalAnticipos", [], "any", false, false, false, 249)), "html", null, true);
            yield "</span></td>
                                </tr>
                            ";
        }
        // line 252
        yield "                            ";
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 252, $this->source); })()), "mtoOperGravadas", [], "any", false, false, false, 252)) {
            // line 253
            yield "                            <tr class=\"border_bottom\">
                                <td align=\"right\"><strong>Op. Gravadas:</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
            // line 255
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 255, $this->source); })()), "html", null, true);
            yield "  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 255, $this->source); })()), "mtoOperGravadas", [], "any", false, false, false, 255)), "html", null, true);
            yield "</span></td>
                            </tr>
                            ";
        }
        // line 258
        yield "                            ";
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 258, $this->source); })()), "mtoOperInafectas", [], "any", false, false, false, 258)) {
            // line 259
            yield "                            <tr class=\"border_bottom\">
                                <td align=\"right\"><strong>Op. Inafectas:</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
            // line 261
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 261, $this->source); })()), "html", null, true);
            yield "  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 261, $this->source); })()), "mtoOperInafectas", [], "any", false, false, false, 261)), "html", null, true);
            yield "</span></td>
                            </tr>
                            ";
        }
        // line 264
        yield "                            ";
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 264, $this->source); })()), "mtoOperExoneradas", [], "any", false, false, false, 264)) {
            // line 265
            yield "                            <tr class=\"border_bottom\">
                                <td align=\"right\"><strong>Op. Exoneradas:</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
            // line 267
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 267, $this->source); })()), "html", null, true);
            yield "  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 267, $this->source); })()), "mtoOperExoneradas", [], "any", false, false, false, 267)), "html", null, true);
            yield "</span></td>
                            </tr>
                            ";
        }
        // line 270
        yield "                            <tr>
                                <td align=\"right\"><strong>I.G.V.";
        // line 271
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "user", [], "any", false, true, false, 271), "numIGV", [], "any", true, true, false, 271)) {
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 271, $this->source); })()), "user", [], "any", false, false, false, 271), "numIGV", [], "any", false, false, false, 271), "html", null, true);
            yield "%";
        }
        yield ":</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
        // line 272
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 272, $this->source); })()), "html", null, true);
        yield "  ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 272, $this->source); })()), "mtoIGV", [], "any", false, false, false, 272)), "html", null, true);
        yield "</span></td>
                            </tr>
                            ";
        // line 274
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 274, $this->source); })()), "mtoISC", [], "any", false, false, false, 274)) {
            // line 275
            yield "                            <tr>
                                <td align=\"right\"><strong>I.S.C.:</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
            // line 277
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 277, $this->source); })()), "html", null, true);
            yield "  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 277, $this->source); })()), "mtoISC", [], "any", false, false, false, 277)), "html", null, true);
            yield "</span></td>
                            </tr>
                            ";
        }
        // line 280
        yield "                            ";
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 280, $this->source); })()), "sumOtrosCargos", [], "any", false, false, false, 280)) {
            // line 281
            yield "                                <tr>
                                    <td align=\"right\"><strong>Otros Cargos:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 283
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 283, $this->source); })()), "html", null, true);
            yield "  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 283, $this->source); })()), "sumOtrosCargos", [], "any", false, false, false, 283)), "html", null, true);
            yield "</span></td>
                                </tr>
                            ";
        }
        // line 286
        yield "                            ";
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 286, $this->source); })()), "icbper", [], "any", false, false, false, 286)) {
            // line 287
            yield "                                <tr>
                                    <td align=\"right\"><strong>I.C.B.P.E.R.:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 289
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 289, $this->source); })()), "html", null, true);
            yield "  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 289, $this->source); })()), "icbper", [], "any", false, false, false, 289)), "html", null, true);
            yield "</span></td>
                                </tr>
                            ";
        }
        // line 292
        yield "                            ";
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 292, $this->source); })()), "mtoOtrosTributos", [], "any", false, false, false, 292)) {
            // line 293
            yield "                                <tr>
                                    <td align=\"right\"><strong>Otros Tributos:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 295
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 295, $this->source); })()), "html", null, true);
            yield "  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 295, $this->source); })()), "mtoOtrosTributos", [], "any", false, false, false, 295)), "html", null, true);
            yield "</span></td>
                                </tr>
                            ";
        }
        // line 298
        yield "                            <tr>
                                <td align=\"right\"><strong>Precio Venta:</strong></td>
                                <td width=\"120\" align=\"right\"><span id=\"ride-importeTotal\" class=\"ride-importeTotal\">";
        // line 300
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 300, $this->source); })()), "html", null, true);
        yield "  ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 300, $this->source); })()), "mtoImpVenta", [], "any", false, false, false, 300)), "html", null, true);
        yield "</span></td>
                            </tr>
                            ";
        // line 302
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 302, $this->source); })()), "perception", [], "any", false, false, false, 302) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 302, $this->source); })()), "perception", [], "any", false, false, false, 302), "mto", [], "any", false, false, false, 302))) {
            // line 303
            yield "                                ";
            $context["perc"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 303, $this->source); })()), "perception", [], "any", false, false, false, 303);
            // line 304
            yield "                                ";
            $context["soles"] = $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog("PEN", "02");
            // line 305
            yield "                                <tr>
                                    <td align=\"right\"><strong>Percepción:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 307
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["soles"]) || array_key_exists("soles", $context) ? $context["soles"] : (function () { throw new RuntimeError('Variable "soles" does not exist.', 307, $this->source); })()), "html", null, true);
            yield "  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["perc"]) || array_key_exists("perc", $context) ? $context["perc"] : (function () { throw new RuntimeError('Variable "perc" does not exist.', 307, $this->source); })()), "mto", [], "any", false, false, false, 307)), "html", null, true);
            yield "</span></td>
                                </tr>
                                <tr>
                                    <td align=\"right\"><strong>Total a Pagar:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 311
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["soles"]) || array_key_exists("soles", $context) ? $context["soles"] : (function () { throw new RuntimeError('Variable "soles" does not exist.', 311, $this->source); })()), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(CoreExtension::getAttribute($this->env, $this->source, (isset($context["perc"]) || array_key_exists("perc", $context) ? $context["perc"] : (function () { throw new RuntimeError('Variable "perc" does not exist.', 311, $this->source); })()), "mtoTotal", [], "any", false, false, false, 311)), "html", null, true);
            yield "</span></td>
                                </tr>
                            ";
        }
        // line 314
        yield "                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody></table>
            <br>
            <br>
            ";
        // line 321
        if ((array_key_exists("max_items", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 321, $this->source); })()), "details", [], "any", false, false, false, 321)) > (isset($context["max_items"]) || array_key_exists("max_items", $context) ? $context["max_items"] : (function () { throw new RuntimeError('Variable "max_items" does not exist.', 321, $this->source); })())))) {
            // line 322
            yield "                <div style=\"page-break-after:always;\"></div>
            ";
        }
        // line 324
        yield "            <div>
                <hr style=\"display: block; height: 1px; border: 0; border-top: 1px solid #666; margin: 20px 0; padding: 0;\"><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                    <tbody><tr>
                        <td width=\"85%\">
                            <blockquote>
                                ";
        // line 329
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "user", [], "any", false, true, false, 329), "footer", [], "any", true, true, false, 329)) {
            // line 330
            yield "                                    ";
            yield CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 330, $this->source); })()), "user", [], "any", false, false, false, 330), "footer", [], "any", false, false, false, 330);
            yield "
                                ";
        }
        // line 332
        yield "                                ";
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "system", [], "any", false, true, false, 332), "hash", [], "any", true, true, false, 332) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 332, $this->source); })()), "system", [], "any", false, false, false, 332), "hash", [], "any", false, false, false, 332))) {
            // line 333
            yield "                                    <strong>Resumen:</strong>   ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 333, $this->source); })()), "system", [], "any", false, false, false, 333), "hash", [], "any", false, false, false, 333), "html", null, true);
            yield "<br>
                                ";
        }
        // line 335
        yield "                                <span>Representación Impresa de la ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 335, $this->source); })()), "html", null, true);
        yield " ELECTRÓNICA.</span>
                            </blockquote>
                        </td>
                        <td width=\"15%\" align=\"right\">
                            <img src=\"";
        // line 339
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Greenter\Report\Filter\ImageFilter')->toBase64($this->env->getRuntime('Greenter\Report\Render\QrRender')->getImage((isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 339, $this->source); })())), "svg+xml"), "html", null, true);
        yield "\" alt=\"Qr Image\">
                        </td>
                    </tr>
                    <tr>
                        <td class=\"bold\">
                          ";
        // line 344
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "user", [], "any", false, true, false, 344), "mensajeImpresion", [], "any", true, true, false, 344)) {
            // line 345
            yield "                           <center>  ";
            yield CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 345, $this->source); })()), "user", [], "any", false, false, false, 345), "mensajeImpresion", [], "any", false, false, false, 345);
            yield " </center>
                          ";
        }
        // line 347
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
        return "invoice.html.twig";
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
        return array (  748 => 347,  742 => 345,  740 => 344,  732 => 339,  724 => 335,  718 => 333,  715 => 332,  709 => 330,  707 => 329,  700 => 324,  696 => 322,  694 => 321,  685 => 314,  677 => 311,  668 => 307,  664 => 305,  661 => 304,  658 => 303,  656 => 302,  649 => 300,  645 => 298,  637 => 295,  633 => 293,  630 => 292,  622 => 289,  618 => 287,  615 => 286,  607 => 283,  603 => 281,  600 => 280,  592 => 277,  588 => 275,  586 => 274,  579 => 272,  571 => 271,  568 => 270,  560 => 267,  556 => 265,  553 => 264,  545 => 261,  541 => 259,  538 => 258,  530 => 255,  526 => 253,  523 => 252,  515 => 249,  511 => 247,  509 => 246,  502 => 241,  497 => 238,  486 => 235,  482 => 234,  479 => 233,  475 => 232,  456 => 215,  454 => 214,  450 => 212,  447 => 211,  437 => 207,  431 => 204,  427 => 202,  422 => 201,  419 => 200,  412 => 196,  405 => 191,  403 => 190,  398 => 187,  392 => 186,  386 => 184,  383 => 183,  379 => 182,  371 => 176,  364 => 172,  357 => 167,  355 => 166,  342 => 156,  329 => 145,  319 => 141,  315 => 140,  309 => 137,  305 => 136,  299 => 133,  293 => 130,  289 => 128,  282 => 127,  278 => 126,  274 => 125,  270 => 123,  266 => 122,  254 => 112,  252 => 111,  248 => 109,  242 => 105,  233 => 104,  229 => 103,  225 => 101,  223 => 100,  215 => 98,  211 => 97,  208 => 96,  202 => 93,  198 => 92,  195 => 91,  193 => 90,  186 => 88,  183 => 87,  177 => 85,  174 => 84,  168 => 83,  164 => 82,  155 => 78,  151 => 77,  147 => 75,  145 => 74,  133 => 65,  125 => 60,  117 => 55,  99 => 42,  91 => 37,  81 => 30,  70 => 22,  62 => 16,  60 => 15,  58 => 14,  56 => 13,  54 => 12,  46 => 6,  44 => 5,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "invoice.html.twig", "C:\\xampp\\htdocs\\puja-last-version\\app\\templates\\invoice.html.twig");
    }
}
