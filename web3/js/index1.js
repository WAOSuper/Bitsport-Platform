let contract = null;
let web3 = null;
let intervalID;
let accounts = null;

const wbnb_address = "0xbb4CdB9CBd36B01bD1cBaEBF2De08d9173bc095c";
const cake_address = "0x0e09fabb73bd3ade0a17ecc321fd13a19e81ce82";
const btp_address = "0x0e09fabb73bd3ade0a17ecc321fd13a19e81ce82";

// Wbnb and BTP address 
// -------------------

const ACCOUNT_PK =
  "";
  // caution
  // -------------------
  //  could be the private address of the wallet

function getWeb3() {
  // -------------------
  // metamask import part.
  return new Promise(async (resolve, reject) => {
    if (window.ethereum) {
      const web3 = new Web3(window.ethereum);
      try {  // ask user permission to access his accounts
        await window.ethereum.request({ method: "eth_requestAccounts" });
        resolve(web3);
      } catch (error) {
        reject(error);
      }
    } else {
      reject("Please install MetaMask");
    }
  });
};

const getContract = async (web3) => {
  const data = await $.getJSON("../web3/contracts/IPancakeRouterV2.json");

  // web3.eth.getBlockNumber()
  // .then(()=> console.log('done'));
  // -------------------
  // you can check the block number anytime from here 

  // console.log(web3.version);
  // -------------------
  // you can check the web3 version anytime from here

  const greeting = await new web3.eth.Contract(data, PANCAKESWAP_ROUTER_V2);
//  make it work Web3 
// -------------------
  return greeting;
};

async function greetingApp() {
  web3 = await getWeb3();
  contract = await getContract(web3);
}

async function transfer() {
  const account = (await web3.eth.getAccounts())[0];

  const amount = $('#typeNumber').val();
  const options = $('#coinOption').val();
  console.log(options)

  // const deadline = Math.round(new Date().getTime() / 1000) + 30;
  // const amount = new BigNumber(0.001);

  // const amountOutMin = "100" + Math.random().toString().slice(2, 6);
  const methodCall = await contract.methods.swapExactETHForTokens(
    0,
    [options === 'cake' ? cake_address : wbnb_address, btp_address],
    account,
    Math.round(Date.now() / 1000) + 60 * 20,        
  ).send(
    {
      from: account,
      value: web3.utils.toWei(amount, 'ether'),
    },
  );

  //  the vlaue is the changable,
  // -------------------
  // in order to work, must value added as a number.
}
// greetingApp();
