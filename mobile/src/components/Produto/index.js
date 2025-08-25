import React from 'react';
import { Image, TouchableHighlight, Text} from 'react-native';
import styles from './style';

function Produto(props){
  return(
    <TouchableHighlight 
      key={props.id}
      style={styles.containerItem}   
      onPress={props.func}>
      <>
        <Image
          style = {styles.imgProduto} 
          source= {{uri: "http://www.tegy.com.br/public/" + props.imgLink}}
        />

        <Text style={styles.textLegenda}>
          {props.legenda}
        </Text>
       </>
    </TouchableHighlight>
  );
}

export default Produto;