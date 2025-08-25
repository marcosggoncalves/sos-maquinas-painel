
import { DatabaseConnection } from './connect';

var db = null;

export default class DatabaseInit {

    constructor() {
        db = DatabaseConnection.getConnection()
            db.exec([{ sql: 'PRAGMA foreign_keys = ON;', args: [] }], false, () =>
            console.log('Foreign keys turned on')
        );

        this.InitDb();
    }

    InitDb() {
         var sql = [
            `create table  if not exists publicidades(
                id int not null primary key,
                imagem text,
                link text,
                cliente text,
                duracao int
            );`,
            `create table  if not exists categorias(
                id int not null primary key,
                categoria text,
                imagem text
            );`,
            `create table  if not exists categorias_simbolos(
                id int not null,
                descricao text,
                imagem text,
                titulo text,
                categoria_id int,
                PRIMARY KEY (id),
                FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
            );`,
            `create table  if not exists simbolos_items(
                id int not null ,
                descricao text,
                tipo varchar(255),
                categoria_simbolo_id int,
                PRIMARY KEY (id),
                FOREIGN KEY (categoria_simbolo_id) REFERENCES categorias_simbolos(id) ON DELETE CASCADE
            );`
        ];

        db.transaction(
            tx => {
                for (var i = 0; i < sql.length; i++) {
                    tx.executeSql(sql[i]);
                }
            }, (error) => {
                console.log(error);
            }, () => {
                console.log("transaction complete call back ");
            }
        );
    }
}