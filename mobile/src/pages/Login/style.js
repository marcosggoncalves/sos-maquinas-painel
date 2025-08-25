import { StyleSheet, Dimensions } from 'react-native';
import colors from '../../styles/colors';
import metrics from '../../styles/metrics';

const {height} = Dimensions.get('window');
const styles = StyleSheet.create({
  container: {
    flex: 1,
    height: (height / 2),
    alignItems: 'center',
    backgroundColor: colors.fundoMain,
  },
  
  form: {
    marginTop: 20,
    padding: 18,
    width: '94%',
    borderRadius: 8,
    alignItems: 'center',
    backgroundColor: colors.branco,
    elevation: 4
  },

  textLogin: {
    fontWeight: '700',
    color: colors.pretoFosco,
    fontSize: metrics.fontTitle,
    textAlign: 'center'
  },

  input: {
    marginTop: 30,
    marginBottom: 15,
    borderBottomWidth: 1,
    borderColor: 'rgba(0,0,0,0.2)',
    width: '100%',
    fontSize: metrics.fontImput,
    paddingBottom: 10,
    paddingTop: 10,
    paddingLeft: 5,
    color: colors.preto07
  },

  containerButton: {
    marginTop: 20,
    width: '100%',
    alignItems: 'center', 
  },

  button: {
    width: 150,
    height: 45,
    backgroundColor: colors.primaryColor,
    justifyContent: 'center',
    alignItems: 'center',
    marginTop: 5,
    borderRadius: 4
  },

  textButton: {
    fontWeight: '500',
    textTransform: 'uppercase',
    color: colors.branco,
    fontSize: metrics.fontButton,
  },

  textError: {
    fontWeight: '700',
    color: colors.error,
    fontSize: metrics.textError
  }
});

export default styles;