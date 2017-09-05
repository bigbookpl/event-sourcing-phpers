<?php


namespace Librarian\Charging\Domain;

use Librarian\Charging\Domain\Event\AccountActivated;
use Librarian\Charging\Domain\Event\AccountCharged;
use Librarian\Charging\Domain\Event\AccountCreated;
use Librarian\Charging\Domain\Event\DebitCanceled;
use Money\Currency;
use Money\Money;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Account extends AggregateRoot
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var Money
     */
    private $balance;

    /**
     * @var AccountState
     */
    private $state;

    public static function create(UuidInterface $id, Currency $currency)
    {
        $account = new self();
        $account->id = $id;
        $account->recordThat(AccountCreated::create($id, $currency));

        return $account;
    }

    public function charge(Money $moneyToCharge)
    {
        if (!$this->canBeCharged($moneyToCharge)) {
            throw new \DomainException();
        }

        /**
         * Zarejestruj zdarzenie utowrzenie konta
         */
        $this->recordThat(AccountCharged::create($this->id, $moneyToCharge));
    }

    private function canBeCharged($moneyToCharge)
    {
        if (AccountState::ACTIVE()->equals($this->state)) {
            return true;
        }
    }

    public function discharge(Money $moneyToDischarge)
    {
        if ($this->canBeDischarged($moneyToDischarge)) {
            throw new \DomainException();
        }

    }

    private function canBeDischarged($moneyToDischarge)
    {
        return true;
    }

    public function cancelDebit($reason)
    {
        if (!$this->caBeDebitCancled()) {
            throw new \DomainException();
        }

        $this->recordThat(DebitCanceled::create($this->id, $reason));
    }

    private function caBeDebitCancled()
    {
        return true;
    }

    public function activate()
    {
        if (!$this->caBeAcitivated()) {
            throw new \DomainException();
        }

        $this->recordThat(AccountActivated::create($this->id));
    }

    private function caBeAcitivated()
    {
        return true;
    }

    public function deactivate()
    {

    }

    public function getBalance(): Money
    {
        return $this->balance;
    }

    protected function aggregateId(): string
    {
        return $this->id;
    }

    protected function apply(AggregateChanged $event): void
    {
        switch (get_class($event)) {
            case AccountCreated::class:
                /** @var AccountCreated $event */
                $this->balance = new Money(0, $event->currency());
                $this->state = AccountState::ACTIVE();
                break;
            case AccountCharged::class:
                $this->balance = $this->balance->add($event->money());
                break;
            case DebitCanceled::class:
                $this->balance = new Money(0, $this->balance->getCurrency());
                break;
            case AccountActivated::class:
                $this->state = AccountState::ACTIVE;
                break;
            default:
                throw new \DomainException();
        }
    }
}