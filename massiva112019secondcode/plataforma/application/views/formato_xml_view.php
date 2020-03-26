<?xml version="1.0" encoding="utf-8"?>
<cfdi:Comprobante Version="3.3" Fecha="<?php echo $comprobante['fecha_emision']; ?>"  
                  Sello="<?php echo $comprobante['sello']; ?>" 
                  SubTotal="<?php echo $comprobante['subtotal']; ?>" Descuento="0.00" Moneda="<?php echo $comprobante['moneda']; ?>" 
                  TipoCambio="<?php echo $comprobante['tipo_cambio'] ?>" 
                  Total="<?php echo $comprobante['total']; ?>" TipoDeComprobante="<?php echo $comprobante['tipo_factura']; ?>" 
                  MetodoPago="<?php echo $comprobante['metodo_pago']; ?>" LugarExpedicion="<?php echo $comprobante['codigo_postal_expedicion']; ?>" 
                  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                  xmlns:cfdi="http://www.sat.gob.mx/cfd/3" 
                  xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd "
                  >
    <cfdi:Emisor Rfc="<?php echo $emisor['rfc']; ?>" Nombre="<?php echo $emisor['razon_social']; ?> " RegimenFiscal="<?php echo $emisor['clave_regimen_fiscal']; ?>" />
    <cfdi:Receptor Rfc="<?php echo $receptor['rfc']; ?>" Nombre="<?php echo $receptor['razon_social']; ?>" UsoCFDI="<?php echo $receptor['uso_factura']; ?>" />
    <cfdi:Conceptos>

        <?php
        foreach ($conceptos['productos'] as $producto) {
            ?>
            <cfdi:Concepto ClaveProdServ="<?php echo $producto['clave_producto_sat']; ?>"  Cantidad="<?php echo $producto['cantidad']; ?>" 
                           ClaveUnidad="<?php echo $producto['clave_unidad_sat'] ?>" Descripcion="<?php echo $producto['descripcion_producto_sat']; ?>" ValorUnitario="<?php echo $producto['precio']; ?>" 
                           Importe="<?php echo $producto['importe']; ?>" Descuento="0.00">
                <cfdi:Impuestos>
                    <cfdi:Traslados>
                        <cfdi:Traslado Base="<?php echo $producto['importe']; ?>" Impuesto="002" TipoFactor="Tasa" TasaOCuota="<?php echo $producto['iva'] ?>" Importe="<?php echo $producto['iva_trasladado']; ?>" />
                    </cfdi:Traslados>
                    <cfdi:Retenciones>
                        <cfdi:Retencion Base="<?php echo $producto['importe']; ?>" Impuesto="002" TipoFactor="Tasa" TasaOCuota="<?php echo $producto['iva_retenido'] ?>" Importe="<?php echo $producto['iva_retenido_calculado']; ?>"/>
                        <cfdi:Retencion Base="<?php echo $producto['importe']; ?>" Impuesto="001" TipoFactor="Tasa" TasaOCuota="<?php echo $producto['isr_retenido'] ?>" Importe="<?php echo $producto['isr_retenido_calculado']; ?>"/>
                    </cfdi:Retenciones>
                </cfdi:Impuestos>
            </cfdi:Concepto>
            <?php
        }
        ?>
        <cfdi:Impuestos TotalImpuestosTrasladados="<?php echo $conceptos['total_iva_trasladados']; ?>" TotalImpuestosRetenidos="<?php echo ($conceptos['total_iva_retenidos'] + $conceptos['total_isr_retenidos']) ?>">
            <cfdi:Retenciones>
                <cfdi:Retencion Impuesto="001" Importe="<?php echo $conceptos['total_isr_retenidos']; ?>" />
                <cfdi:Retencion Impuesto="002" Importe="<?php echo $conceptos['total_iva_retenidos']; ?>" />
            </cfdi:Retenciones>
            <cfdi:Traslados>
                <cfdi:Traslado Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="<?php echo $conceptos['total_iva_trasladados']; ?>" />
            </cfdi:Traslados>
        </cfdi:Impuestos>
    </cfdi:Conceptos>   
</cfdi:Comprobante>