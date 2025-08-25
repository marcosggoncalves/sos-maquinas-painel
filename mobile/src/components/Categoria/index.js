import React from 'react';
import { Text, Image, TouchableHighlight} from 'react-native';
import styles from './style';

function Categoria(props){

  return(
    <TouchableHighlight 
      key={props.id}
      style={styles.containerItem}
      onPress={props.func}>
  
        <>
          <Image
            style = {styles.imgCategoria} 
            source= {{uri: "http://www.tegy.com.br/public/" + props.imgLink}}
          />

          <Text style={styles.textLegenda}>
            {props.legenda}
          </Text>
        </>
    </TouchableHighlight>
  );
}

export default Categoria;