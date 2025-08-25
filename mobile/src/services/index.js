import {DatabaseConnection} from '../database/connect';

const db = DatabaseConnection.getConnection();

export const findAll = (table) => {
    return new Promise((resolve, reject) => db.transaction(tx => {
        tx.executeSql(`select * from ${table}`, [], (_, { rows }) => {
            resolve(rows)
        }), (sqlError) => {
            console.log(sqlError);
        }}, (txError) => {
        console.log(txError);
    }))
}

export const atualizar = (sql) =>{
   return new Promise((resolve, reject) => db.transaction(tx => {
        for (var i = 0; i < sql.length; i++) {
            tx.executeSql(sql[i]);
        }
   }));   
}

export const deletar = (sql) =>{
   return new Promise((resolve, reject) => db.transaction(tx => {
        tx.executeSql('delete from categorias');
        tx.executeSql('delete from publicidades');
   }));   
}