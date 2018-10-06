use torent;
/*llaves foráneas*/
/*
alter table tr02usu
add constraint `fk_persona_usuario`
foreign key (`idp_01in`)
references `tr01per` (`idp_01in`);
*/
/*alter table tr02usu
add constraint `fk_rol_usuario`
foreign key (`idr_03in`)
references `tr03rol`(`idr_03in`);*/

/*alter table tr05rol_pri
add constraint `fk_rol`
foreign key (`idr_03in`)
references `tr03rol` (`idr_03in`);*/

alter table tr05usu_pri
add constraint `fk_privilegio`
foreign key (`idp_04in`)
references `tr04pri` (`idp_04in`);

alter table tr05usu_pri
add constraint `fk_usuario`
foreign key (`nus_02in`)
references `tr02usu` (`nus_02in`);
/*
alter table tr06cli
add constraint `fk_persona_afiliado`
foreign key (`idp_01in`)
references `tr01per` (`idp_01in`);

alter table tr07emp
add constraint `fk_persona_fiador`
foreign key (`idp_01in`)
references `tr01per` (`idp_01in`);
*/
alter table tr10her
add constraint `fk_marca_herramienta`
foreign key (`cgm_09in`)
references `tr09mar` (`cgm_09in`);

alter table tr10her
add constraint `fk_nombreherramienta_herramienta`
foreign key (`idn_08in`)
references `tr08nhr` (`idn_08in`);

alter table tr11alq
add constraint `fk_usuario_alquiler`
foreign key (`nus_02in`)
references `tr02usu` (`nus_02in`);

alter table tr11alq
add constraint `fk_herramienta_alquiler`
foreign key(`chr_10in`)
references `tr10her` (`chr_10in`);

alter table tr11alq
add constraint `fk_cliente_alquiler`
foreign key(`ncl_06in`)
references `tr06cli` (`ncl_06in`);
