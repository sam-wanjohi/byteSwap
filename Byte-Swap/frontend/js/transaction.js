document.addEventListener('DOMContentLoaded', async () => {
    const response = await fetch('/backend/api/transaction/list_transactions.php');
    const transactions = await response.json();

    const transactionsDiv = document.getElementById('transactions');
    transactions.forEach(transaction => {
        const transactionDiv = document.createElement('div');
        transactionDiv.className = 'transaction';
        transactionDiv.innerHTML = `
            <p>Transaction ID: ${transaction.id}</p>
            <p>User ID: ${transaction.user_id}</p>
            <p>Food ID: ${transaction.food_id}</p>
            <p>Points: ${transaction.points}</p>
            <p>Status: ${transaction.status}</p>
        `;
        transactionsDiv.appendChild(transactionDiv);
    });
});
