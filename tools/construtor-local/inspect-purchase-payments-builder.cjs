const c=require('./purchase-payments-builder-common.cjs');
c.session(async({api})=>{const {receipt}=await c.inspect(api);console.log(JSON.stringify(receipt));if(receipt.collisions.length||receipt.operationConflicts.length)process.exitCode=2;}).catch(e=>{console.error(e.message);process.exitCode=1;});
